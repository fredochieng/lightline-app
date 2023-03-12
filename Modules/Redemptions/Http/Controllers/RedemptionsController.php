<?php

namespace Modules\Redemptions\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Redemptions\Entities\Entities\Models\Redemption;

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
                    $update_points = DB::table('user_points')->update([
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
