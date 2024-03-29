<?php

namespace App\Jobs;

use App\Models\AfricasTalkingAirtime;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use AfricasTalking\SDK\AfricasTalking;
use Modules\Redemptions\Entities\Entities\Models\Redemption;

class SendAirtimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ke_airtime_username = AfricasTalkingAirtime::get_ke_airtime_username();
        $ke_airtime_api_key   = AfricasTalkingAirtime::get_ke_airtime_api_key();
        $currency = 'KES';
        $current_time = Carbon::now('Africa/Nairobi')->toDateTimeString();

        $status = 1;
        $airtime_sent = 1;
        $country_codes = ['ke'];
        //$country_ids = array(110);

        $redemption_requests = Redemption::getRedemptionsForAirtime()
            ->whereIn('country_code', $country_codes)
            //->get()
            ->take(1);
        print_r($redemption_requests);

        //dd($redemption_requests);

        // Initialize the SDK
        $AT = new AfricasTalking($ke_airtime_username, $ke_airtime_api_key);

        // Get the airtime service
        $airtime  = $AT->airtime();


        if (count($redemption_requests) > 0) {
            foreach ($redemption_requests as $key => $value) {
                // Set the numbers you want to send to in international format
                $phone_nos = $value->phone_number;
                $phone_nos = '254722314967';
                $amount = $value->points_redeemed;
                $amount = 5;

                try {
                    // Set the phone number, currency code and amount in the format below
                    $recipients = [[
                        "phoneNumber"  => $phone_nos,
                        "currencyCode" => $currency,
                        "amount"       => $amount
                    ]];

                    // That's it, hit send and we'll take care of the rest
                    $results = $airtime->send([
                        "recipients" => $recipients
                    ]);

                    print_r($results);
                    //exit;

                    foreach ($results as $key => $status) {

                        if ($results['data']->responses['0']->status == 'Sent') {

                            $update_request = array(
                                'status' => 2,
                                'date_paid' => $current_time,
                                'request_id' => $results['data']->responses['0']->requestId,
                                'amount_sent' => $results['data']->responses['0']->amount,
                                'at_dsc' => $results['data']->responses['0']->discount,
                                'phone_sent_to' => $results['data']->responses['0']->phoneNumber,
                                'at_status' => $results['data']->responses['0']->status,
                            );
                            $update_request_status = Redemption::where('id', $value->id)->update($update_request);
                        }
                    }

                    print_r($results);
                } catch (Exception $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }





















        // Set the phone number, currency code and amount in the format below
        // $recipients = [[
        //     "phoneNumber"  => $recepients,
        //     "currencyCode" => $currency,
        //     "amount"       => 200
        // ]];

        // try {
        //     // That's it, hit send and we'll take care of the rest
        //     $results = $airtime->send([
        //         "recipients" => $recipients
        //     ]);

        //     print_r($results);
        // } catch (Exception $e) {
        //     echo "Error: " . $e->getMessage();
        // }
    }
}
