<?php

namespace App\Console\Commands;

use App\Models\Constant;
use App\Models\Payment;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\SendMail;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsCheck extends Command
{

    // private string $token;
    private string $apiKey;
    private string $apiUser;
    private array $headers;
    private Client $client;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check payments table to see if a request have been paid';

    /**
     * Execute the console command.
     */
    // public function start($base_url = "https://campay.net/api/")
    // {
    //     $this->client = new Client([
    //         'base_uri' => $base_url,
    //         'timeout' => 30 // 30 sec timeout
    //     ]);

    //     $this->token = $this->request_token();
    // }
    public function start($base_url = "https://live.fapshi.com/")
    {
        $this->client = new Client([
            'base_uri' => $base_url,
            'timeout' => 30,
            'verifie' => true
        ]);

        $this->apiKey = config('app.fapshi_api_key');
        $this->apiUser = config('app.fapshi_api_user');

        $this->setHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'apikey' => $this->apiKey,
            'apiuser' => $this->apiUser,
        ]);
    }
    private function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
    // private function request_token()
    // {
    //     $config = [
    //         "username" => config('app.campay_username'),
    //         "password" => config('app.campay_password'),

    //     ];

    //     $options = [
    //         "form_params" => $config
    //     ];

    //     $response = $this->client->post('token/', $options);
    //     $data = json_decode($response->getBody());
    //     $this->setHeaders([
    //         "Authorization" => "Token " . $data->token
    //     ]);
    //     return $data->token;
    // }
    public function getTransactionStatus($payment)
    {
        $uri = "payment-status/" . $payment->transaction_id . "/";
        $response = $this->client->get($uri, [
            "headers" => $this->headers
        ]);
        $response_data = $response->getBody()->getContents();
        $status = json_decode($response_data)?->status;
        if ($status == 'SUCCESSFUL') {
            if ($payment) {
                $payment->status = 'successful';
                $payment->request->paid = true;
                $payment->request->save();
                $payment->save();
                if (!$payment->user->referal_paid) {
                    if (!$payment->user->referer->wallet()) {
                        Wallet::create([
                            'user_id' => $payment->user->referer->id
                        ]);
                    }
                    $payment->user->referer->wallet()->update(
                        [
                            'balance' => $payment->user->referer->wallet()->balance + Constant::find(1)->value,
                        ]
                    );
                    $payment->user->referal_paid = true;
                    $payment->user->save();
                    $details['greeting'] = 'Dear ' . $payment->user->referer->name;
                    $details['subject'] = 'Referal Payment';
                    $details['body'] = "<p>Your Referal just paid for his first document so your account have been credited ";
                    $user = $payment->user->referer;
                    try {
                        Notification::send($user, new SendMail($details));
                        $this->info("Message sent successfully");
                    } catch (\Exception $e) {
                        $this->info("email error");
                    }
                }
                $details['greeting'] = 'Dear ' . $payment->user->name;
                $details['subject'] = 'Paper Request Status';
                $details['body'] = "<p>The payment of the Paper you requested for was successful. Visit our site for futher processing ";
                $user = $payment->user;
                try {
                    Notification::send($user, new SendMail($details));
                    $this->info("Message sent successfully");
                } catch (\Exception $e) {
                    $this->info("email error");
                }
                $details['greeting'] = 'Dear Admin';
                $details['subject'] = 'New Paper Bought';
                $details['body'] = "<p>You have a new document bought on the website.";
                $admins = User::where('role', 'admin')->get();
                try {
                    Notification::send($admins, new SendMail($details));
                    $this->info("Message sent successfully");
                } catch (\Exception $e) {
                    $this->info("email error");
                }
            }
        } elseif ($status == 'FAILED') {
            if ($payment) {
                $payment->status = 'failed';
                $payment->save();
                $details['greeting'] = 'Dear ' . $payment->user->name;
                $details['subject'] = 'Paper Request Status';
                $details['body'] = "<p>The payment of the document you requested for has failed. Please consider reapplying or contact support if you were debitted already ";
                $user = $payment->user;
                try {
                    Notification::send($user, new SendMail($details));
                    $this->info("Message sent successfully");
                } catch (\Exception $e) {
                    $this->info("email error");
                }
            }
        }
    }
    public function handle()
    {
        $payments = Payment::where('status', 'pending')->get();
        if ($payments->count() == 0) {
            $this->info('No payment to check');
            return;
        }
        foreach ($payments as $payment) {
            $this->start();
            $this->getTransactionStatus($payment);
            $this->info($payment->transaction_id . ' marked as ' . $payment->status);
        };
    }
}
