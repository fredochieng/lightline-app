<?php

namespace Modules\Redemptions\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\DB;
use Modules\Panel\Entities\UserDetail;
use Modules\Panel\Entities\UserPoint;
use Modules\Redemptions\Entities\PointBulkUpload;

class ProcessPointUploadJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;
    public $reason;
    public $batch_uuid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header, $reason, $batch_uuid)
    {
        $this->data = $data;
        $this->header = $header;
        $this->reason = $reason;
        $this->batch_uuid = $batch_uuid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $key => $value) {

            $res = [];

            foreach ($this->header as $ind => $num) {
                $res[$num] = $value[$ind] === "" ? "0" : $value[$ind];
            }

            $bulk = array_combine($this->header, $res);

            $panel_no  = $value[0];
            $points  = $bulk['points'];
            $user = UserDetail::where('panel_no', $panel_no)->first('user_id');
            if (!empty($user)) {
                /** Get user points data */
                // DB::beginTransaction();

                // try {

                $user_id = $user->user_id;
                /** Get user points */
                $user_points = UserPoint::where('user_id', $user_id)->first();

                if (!empty($user_points)) {
                    $points_earned = $user_points->points_earned;
                    $current_balance = $user_points->points_balance;

                    /** Update new points balance for the user */
                    $update_points = DB::table('user_points')->where('user_id', $user_id)->update([
                        'points_earned' => $points_earned + $points,
                        'points_balance' => $current_balance + $points
                    ]);

                    /** Save points history (transaction) */
                    $activity = $this->reason;
                    $tx_type = 'Credit';
                    $transaction_id = substr(str_shuffle("0123456789"), 0, 8);
                    DB::table('point_transactions')
                        ->insert([
                            'user_id' => $user_id,
                            'points' => $points,
                            'transaction_id' => $transaction_id,
                            'activity' => $activity,
                            'tx_type' => $tx_type,
                            'created_at' => Carbon::now('Africa/Nairobi')->toDateTimeString(),
                            'updated_at' => Carbon::now('Africa/Nairobi')->toDateTimeString()
                        ]);

                    DB::commit();
                }

                $update_batch = PointBulkUpload::where('uuid', $this->batch_uuid)->update([
                    'upload_processed' => 'Yes'
                ]);
            } else {
            }
        }
    }
}
