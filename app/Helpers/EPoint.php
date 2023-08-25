<?php

namespace App\Helpers;

use App\Models\ElanFunctions;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\UserBalances;
use App\Models\UserPackages;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Payments;

class EPoint
{
    public static function createPayment($amount, $order)
    {
        $params = [
            "amount" => urlencode(number_format($amount, 2)),
            "currency" => urlencode('AZN'),
            "description" => urlencode($order->data['title'] ?? ' '),
            "language" => urlencode('az'),
            "public_key" => env('EPOINTPUBLIC_KEY'),
            "order_id" => $order->id,
            'success_redirect_url' => env('EPOINTSUCCESSURL'),
            'error_redirect_url' => env('EPOINTERRORSURL'),
        ];

        $data = base64_encode(json_encode($params));
        $signature = base64_encode(sha1("" . env('EPOINTPRIVATE_KEY') . "$data" . env('EPOINTPRIVATE_KEY') . "", true));


        $client = new Client();
        $response = $client->request('POST', config('services.epoint.client_url'), [
            'form_params' => [
                'data' => $data,
                'signature' => $signature,
            ]
        ]);

        $response = json_decode($response->getBody());

        if (isset($response) && !empty($response) && isset($response->status) && $response->status == "success") {
            $order->update(['transaction_id' => $response->transaction]);
            return redirect()->to($response->redirect_url);
        } else {
            return $response->message;
        }
    }


    public static function paymentProcess($order)
    {
        $params = [
            'public_key' => env('EPOINTPUBLIC_KEY'),
            'order_id' => $order->id,
            'transaction' => $order->transaction_id
        ];

        $data = base64_encode(json_encode($params));
        $signature = base64_encode(sha1("" . env('EPOINTPRIVATE_KEY') . "$data" . env('EPOINTPRIVATE_KEY') . "", true));

        $client = new Client();
        $response = $client->request('POST', config('services.epoint.get_status_url'), [
            'form_params' => [
                'data' => $data,
                'signature' => $signature,
            ]
        ]);

        $response = json_decode($response->getBody());

        if (isset($response) && !empty($response) && isset($response->bank_response) && !empty($response->bank_response)) {
            $order->update(['frompayment' => $response->bank_response]);
        }

        if (isset($response) && !empty($response) && isset($response->status) && !empty($response->status) && $response->status == "success") {
            $payment=Payments::find($order->id);
            $payment->update(['payment_status'=>1]);
        }

        return $response;
    }
}
