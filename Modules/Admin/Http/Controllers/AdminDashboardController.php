<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Panel\Entities\UserPoint;
use Modules\Redemptions\Entities\Entities\Models\Redemption;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboardView()
    {
        $panels = User::where('registration_type', '!=', NULL)->get();
        $data['total_panel'] = count($panels);
        $data['active_panel'] = count($panels->where('status', 1));
        $data['inactive_panel'] = count($panels->where('status', 0));
        $data['total_referrals'] = count($panels->where('status', 1)->where('registration_type', 2));

        /** Get points statistics */
        $points = DB::table('user_points as pt')->select(
            DB::raw('pt.points_earned'),
            DB::raw('pt.points_redeemed'),
            DB::raw('pt.points_balance')
        )->get();

        $tot_points_awarded = array();

        foreach ($points as $value) {
            $tot_points_awarded[] = $value->points_earned;
        }

        if (!empty($tot_points_awarded)) {
            $data['sum_points_awarded'] = number_format(json_encode(array_sum($tot_points_awarded)), 0, '.', ',');
        } else {
            $data['sum_points_awarded'] = 0;
        }

        $tot_points_redeemed = array();

        foreach ($points as $value) {
            $tot_points_redeemed[] = $value->points_redeemed;
        }

        if (!empty($tot_points_redeemed)) {
            $data['sum_points_redeemed'] = number_format(json_encode(array_sum($tot_points_redeemed)), 0, '.', ',');
        } else {
            $data['sum_points_redeemed'] = 0;
        }

        $tot_points_balance = array();

        foreach ($points as $value) {
            $tot_points_balance[] = $value->points_balance;
        }

        if (!empty($tot_points_balance)) {
            $data['sum_points_balance'] = number_format(json_encode(array_sum($tot_points_balance)), 0, '.', ',');
        } else {
            $data['sum_points_balance'] = 0;
        }

        /** Redemptions statistics */
        $redemptions = DB::table('redemptions as r')->select(
            DB::raw('r.points_redeemed'),
            DB::raw('r.status')
        )->get();

        $data['total_pending_redemptions'] = count($redemptions->where('status', 1));
        $data['total_completed_redemptions'] = count($redemptions->where('status', 2));


        /** Get pending amount sum */
        $pending_redemptions = Redemption::getPanelRedemptions()
            ->where('status', 1)->where('date_paid', '=', NULL);

        $pending_redemptions_amount = array();

        foreach ($pending_redemptions as $value) {
            $pending_redemptions_amount[] = $value->points_redeemed;
        }

        if (!empty($pending_redemptions_amount)) {
            $data['pending_redemptions_amount'] = number_format(json_encode(array_sum($pending_redemptions_amount)), 2, '.', ',');
        } else {
            $data['pending_redemptions_amount'] = "0.00";
        }

        /** Get completed amount sum */
        $completed_redemptions = Redemption::getPanelRedemptions()
            ->where('status', 2);

        $completed_redemptions_amount = array();

        foreach ($completed_redemptions as $value) {
            $completed_redemptions_amount[] = $value->points_redeemed;
        }

        if (!empty($completed_redemptions_amount)) {
            $data['completed_redemptions_amount'] = number_format(json_encode(array_sum($completed_redemptions_amount)), 2, '.', ',');
        } else {
            $data['completed_redemptions_amount'] = "0.00";
        }




        // $total = count($panels);

        return view('admin::dashboard')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
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
