<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CampayController extends Controller
{
    private string $token;
    private array $headers;
    private Client $client;
    public User $user;

    public function __construct($base_url = "https://demo.campay.net/api/")
    {
        $this->user = Auth::guard('api')->user();
        $this->client = new Client([
            'base_uri' => $base_url,
            'timeout' => 30 // 30 sec timeout
        ]);

        $this->token = $this->request_token();
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

    public function collect(Request $request)
    {
        $data = $request->all();
        $data['token'] = $this->token; // Add token to the data array

        $uri = "collect/";
        $response = $this->client->post($uri, [
            "form_params" => $data,
            "headers" => $this->headers
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        // Extract the reference from the response
        $reference = $responseData['reference'] ?? null;
        $operator = $responseData['operator'] ?? null;

        // Log the payment details in the payments table
        $payment = new Payment();
        $payment->request_id = $request->request_id;
        $payment->user_id = $this->user->id; //Auth::id();
        $payment->amount = $data['amount'];
        $payment->description = $request->request_id;
        $payment->transaction_id = $reference;
        $payment->payment_method = $operator;
        $payment->save();

        return $responseData;
    }

    public function getTransactionStatus(Request $request)
    {
        $uri = "transaction/" . $request->reference . "/";
        $response = $this->client->get($uri, [
            "headers" => $this->headers
        ]);
        $response_data = $response->getBody()->getContents();
        $status = json_decode($response_data)?->status;
        if($status == 'SUCCESSFUL'){
            $payment = Payment::where('transaction_id', $request->reference)->first();
            if($payment){
                $payment->status = 'successful';
                $payment->save();
            }
            return response()->json([
               'success' => true,
               'message' => 'Payment successful'
            ]);
        } else{
            return response()->json([
               'success' => false,
               'message' => 'Payment failed Try again later'
            ]);
        }
    }

    public function withdraw(Request $request)
    {
        $data = $request->all();
        $uri = "withdraw/";
        $response = $this->client->post($uri, [
            "form_params" => $data,
            "headers" => $this->headers
        ]);
        return $response->getBody()->getContents();
    }

    public function getAppBalance()
    {
        $uri = "balance/";
        $response = $this->client->get($uri, [
            "headers" => $this->headers
        ]);
        return $response->getBody()->getContents();
    }

    public function transactionHistory(Request $request)
    {
        $date = new Carbon();
        $start = $request->input('start', $date->subWeek()->format('Y-m-d'));
        $end = $request->input('end', Carbon::now()->format('Y-m-d'));

        $params = [
            "start_date" => date_format(new \DateTime($start), "Y-m-d"),
            "end_date" => date_format(new \DateTime($end), "Y-m-d"),
        ];

        $uri = "history/";
        $response = $this->client->post($uri, [
            "form_params" => $params,
            "headers" => $this->headers
        ]);

        return $response->getBody()->getContents();
    }

    public function generatePaymentUrl(Request $request)
    {
        $params = $request->all();
        $uri = "get_payment_link/";
        $response = $this->client->post($uri, [
            "form_params" => $params,
            "headers" => $this->headers
        ]);
        return $response->getBody();
    }

    private function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    private function getHeaders(): array
    {
        return $this->headers;
    }
}
