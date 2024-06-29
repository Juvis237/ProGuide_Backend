<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Request as ModelsRequest;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class PaymentsCheck extends Command
{

    private string $token;
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
    public function start($base_url = "https://demo.campay.net/api/")
    {
        $this->client = new Client([
            'base_uri' => $base_url,
            'timeout' => 30 // 30 sec timeout
        ]);

        $this->token = $this->request_token();
    }
    private function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
    private function request_token()
    {
        $config = [
            "username" => env('CAMPAY_USERNAME', 'zn4QATUy-7p694Dk4zYOG0erI084uKQ3cJU0rFuzgV_CJJf4jddAeLnibhXtX39OmLEOKFgKP5z_cacnswMBpg'),
            "password" => env('CAMPAY_PASSWORD', 'rTSZCxVsQh03Zg5w98b7h63w0pAJ9SXQ1z7tFDnhBa6lNLtw3qvQ-bGc8rmYui5G9ipb2DLj40aXUzRBHCmomw')
        ];

        $options = [
            "form_params" => $config
        ];

        $response = $this->client->post('token/', $options);
        $data = json_decode($response->getBody());
        $this->setHeaders([
            "Authorization" => "Token " . $data->token
        ]);
        return $data->token;
    }
    public function getTransactionStatus($payment)
    {
        $uri = "transaction/" . $payment->transaction_id . "/";
        $response = $this->client->get($uri, [
            "headers" => $this->headers
        ]);
        $response_data = $response->getBody()->getContents();
        $status = json_decode($response_data)?->status;
        if($status == 'SUCCESSFUL'){
            if($payment){
                $payment->status = 'successful';
                $payment->request->paid = true;
                $payment->save();
            }

        } elseif($status == 'FAILED'){
            if($payment){
                $payment->status = 'failed';
                $payment->save();
            }
        }
    }
    public function handle()
    {
        $payments = Payment::where('status', 'pending')->get();
        if($payments->count()==0){
            $this->info('No payment to check');
            return;
        }
        foreach ($payments as $payment){
           
            $this->start();
            $this->getTransactionStatus($payment);
            $this->info($payment->reference.' marked as '. $payment->status);
        };
    }
}
