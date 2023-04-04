<?php

namespace Modules\Redemptions\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Redemptions\Entities\Entities\Models\Redemption;
use Modules\Redemptions\Entities\PointBulkUpload;
use Ramsey\Uuid\Uuid;
use Alert;
use Illuminate\Support\Facades\Bus;
use Modules\Redemptions\Jobs\ProcessPointUploadJob;

class RedemptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $data['user_points'] = Redemption::getUserPoints($user_id);
        return view('redemptions::redemptions')->with($data);
    }

    public function getUserRedemptions()
    {

        $user_id = Auth::user()->id;
        $data['user_points'] = Redemption::getUserPoints($user_id);
        $redemtions = Redemption::getUserRedemption($user_id);
        $userRedemptions['data'] = $redemtions;
        return response()->json($userRedemptions);
    }

    /** For panel */
    public function transactionsList()
    {
        return view('redemptions::transactions');
    }

    public function getPanelPointTransactions()
    {
        $user_id = Auth::user()->id;
        $myRedemptions = Redemption::getUserPointTransactions($user_id);
        $panelRedemptions['data'] = $myRedemptions;

        return response()->json($panelRedemptions);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('redemptions::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $points_balance = $request->input('points_balance');
        $redeem_points = $request->input('redeem_points');
        $new_balance = $request->input('new_balance');
        $expected_date = Carbon::now('Africa/Nairobi')->toDateTimeString();
        $redemption_no = strtoupper(substr(str_shuffle("0123456789"), 0, 8));

        DB::beginTransaction();

        try {
            $user_id = Auth::user()->id;
            $redemption = new Redemption();
            $redemption->user_id = $user_id;
            $redemption->points_redeemed = $redeem_points;
            $redemption->expected_date = $expected_date;
            $redemption->payment_mode = 1;
            $redemption->status = 1;
            $redemption->redemption_no = $redemption_no;

            /** Don't allow redemption of less than 50 points */
            if ($redeem_points >= 50) {

                /** Allow redemption only when points redeemed is less or equal to points balance */
                if ($redeem_points <= $points_balance) {
                    $redemption->save();

                    /** Get user points */
                    $user_points = Redemption::getUserPoints($user_id);
                    $current_redeemed = $user_points->points_redeemed;
                    $current_balance = $user_points->points_balance;

                    /** Update new points balance for the user */
                    $update_points = DB::table('user_points')->where('user_id', $user_id)->update([
                        'points_redeemed' => $current_redeemed + $redeem_points,
                        'points_balance' => $current_balance - $redeem_points
                    ]);

                    /** Save points history (transaction) */
                    $activity = 'Redemption';
                    $tx_type = 'Debit';
                    $transaction_id = substr(str_shuffle("0123456789"), 0, 8);
                    DB::table('point_transactions')
                        ->insert([
                            'user_id' => $user_id,
                            'points' => $redeem_points,
                            'transaction_id' => $transaction_id,
                            'activity' => $activity,
                            'tx_type' => $tx_type,
                            'created_at' => Carbon::now('Africa/Nairobi')->toDateTimeString(),
                            'updated_at' => Carbon::now('Africa/Nairobi')->toDateTimeString()
                        ]);

                    DB::commit();
                    /** Return message to the user (response) */
                    return json_encode(array(
                        "statusCode" => 200,
                        "message" => 'Point redemption successful'
                    ));
                } else {

                    /** Return message to the user (response) */
                    return json_encode(array(
                        "statusCode" => 201,
                        "message" => 'You cannot redeem points more than your balance'
                    ));
                }
            } else {
                /** Return message to the user (response) */
                return json_encode(array(
                    "statusCode" => 201,
                    "message" => 'You cannot redeem points less than 50'
                ));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            /** Return response with status code */
            return json_encode(array(
                "statusCode" => 201,
                "message" => 'Redemption failed'
            ));
        }
    }

    /** For admin */
    public function showTransView()
    {
        return view('admin::points-management/point-trans');
    }

    public function pointsTransactionsFetch()
    {
        $user_id = Auth::user()->id;
        $point_transactions = Redemption::getUserPointTransactions($user_id);
        $userPointTransactions['data'] = $point_transactions;

        return response()->json($userPointTransactions);
    }

    public function showRedemptionsView()
    {
        return view('admin::redemptions-management/redemptions');
    }

    public function panelRedemptionsFetch()
    {
        $user_id = Auth::user()->id;
        $point_transactions = Redemption::getPanelRedemptions();
        $userPointTransactions['data'] = $point_transactions;

        return response()->json($userPointTransactions);
    }

    public function uploadPointsFile()
    {
        // Alert::success('Success Title', 'Success Message');
        // alert('Title', 'Lorem Lorem Lorem', 'success');
        toast('Your Post as been submited!', 'success');
        return view('admin::points-management/upload-points');
    }

    public function saveUploadPointsFile(Request $request)
    {

        $path = storage_path('uploads/points/history');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('csv_file');
        $original_file_name = $file->getClientOriginalName();
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        $data = array_map('str_getcsv', file($path . '/' . $name));

        $header_fields = $data[0];
        $csv_data = array_slice($data, 0, 1000);
        $header0 = trim($header_fields[0]);
        $header1 = trim($header_fields[1]);

        $header0 = preg_replace('/^\xEF\xBB\xBF/', '', $header0);
        $header1 = preg_replace('/^\xEF\xBB\xBF/', '', $header1);

        // Check headers
        if (($header0 === "panel") && ($header1 === "points")) {
            $header_row = array_shift($csv_data);
            // Check point values
            $invalid_rows = [];
            foreach ($csv_data as $key => $row) {
                $panel = $row[0];
                $points = $row[1];
                //dd($points);
                if (!is_numeric($points)) {

                    $invalid_rows[] = $key + 1; // Add 2 to convert 0-based index to 1-based row number, and skip header row
                }
            }

            if (!empty($invalid_rows)) {
                // Return an error message with the list of rows with invalid point values
                $message = "The following rows have invalid point values: " . implode(", ", $invalid_rows);

                return back()->withInput()->withErrors(['csv_file' => $message]);
            } else {
                // Check if any row has empty values

                array_unshift($csv_data, $header_row);

                $empty_rows = [];
                foreach ($csv_data as $key => $row) {
                    foreach ($row as $value) {
                        if (empty($value)) {
                            $empty_rows[] = $key + 1; // Add 2 to convert 0-based index to 1-based row number, and skip header row
                            break;
                        }
                    }
                }

                if (!empty($empty_rows)) {
                    // Return an error message with the list of rows with empty values
                    $message = "The following rows have empty values: " . implode(", ", $empty_rows);

                    return back()->withInput()->withErrors(['csv_file' => $message]);
                } else {
                    array_unshift($data, $header_row);
                    $csv_data = json_encode($csv_data, JSON_UNESCAPED_UNICODE);


                    $csv_data_file = PointBulkUpload::create([
                        'uuid' => Uuid::uuid4(),
                        'reason' => $request->input('purpose'),
                        'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                        'csv_header' => $request->has('header'),
                        'unique_file_name' => $name,
                        'csv_data' => $csv_data,
                    ]);

                    $upload_uuid = $csv_data_file->uuid;

                    return redirect()->route('admin.points.bulk.preview', $upload_uuid)->with(['bulk' => $csv_data]);
                }
            }
        } else {

            $message = "Invalid headers. The first column should be 'panel_no' and the second column should be 'points'.";

            return back()->withInput()->withErrors(['csv_file' => $message]);
        }
    }

    public function uploadFilePreview($id)
    {
        $preview_data = PointBulkUpload::where('uuid', $id)->get();
        $unique_file_name = $preview_data[0]->unique_file_name;
        $reason = $preview_data[0]->reason;
        $csv_data = $preview_data[0]->csv_data;
        $created_at = $preview_data[0]->created_at;
        $batch_status = $preview_data[0]->upload_processed;
        $data_array = json_decode($csv_data, true);
        $data_rows = array_slice($data_array, 1);

        return view('admin::points-management/upload-preview', [
            'rows' => $data_rows, 'data_file_uuid' => $id, 'unique_file_name' => $unique_file_name,
            'reason' => $reason, 'batch_status' => $batch_status, 'created_at' => $created_at
        ]);
    }

    public function processUploadPointsFile(Request $request)
    {
        $data_file_uuid = $request->input('data_file_uuid');
        $unique_file_name = $request->input('unique_file_name');
        $reason = $request->input('reason');
        $path = storage_path('uploads/points/history');

        $data = file($path . '/' . $unique_file_name);
        $chunks = array_chunk($data, 1000);
        $header = [];

        $batch = Bus::batch([])->dispatch();

        foreach ($chunks as $key => $chunk) {

            $data = array_map('str_getcsv', $chunk);
            unset($data[0]);
            $header = config('app.points_bulk_upload_fields');
            $batch->add(new ProcessPointUploadJob($data, $header, $reason, $data_file_uuid));
        }

        return redirect()->route('admin.show.award.points');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('redemptions::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('redemptions::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
