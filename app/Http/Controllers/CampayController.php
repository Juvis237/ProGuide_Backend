<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampayController extends Controller
{
    private string $apiKey;
    private string $apiUser;
    private array $headers;
    private Client $client;
    public User $user;

    public function __construct($base_url = "https://sandbox.fapshi.com/")
    {
        $this->user = Auth::guard('api')?->user();
        $this->client = new Client([
            'base_uri' => $base_url,
            'timeout' => 30, // 30 sec timeout
            'verify' => false
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


    /**
     * MAKE PAYMENT
     * Endpoint to pay for a past paper
     *
     * @queryParam request_id required  REQUEST ID
     * @queryParam amount required Valid amount
     * @queryParam from required Valid phone number
     * @queryParam description optional Transaction Description
     * @request /pay?request_id=REQUESTID&amount=AMOUNT&from=PHONENUMBER
     * @method POST
     */

    public function collect(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'request_id' => 'required',
            'amount' => 'required|numeric|min:100',
            'from' => 'required|string|regex:/^6\d{8}$/',
            'payment_method' => 'nullable|string|in:mobile money,orange money',
            'message' => 'nullable|string|max:255'
        ]);

        if ($validated->fails()) {
            return response(['success' => false, 'message' => $validated->errors()->first()]);
        }

        $data = $data = [
            'amount' => $request->amount,
            'phone' => $request->from,
            'userId' => $this->user->id,
            'message' => $request->message ?? 'Payment for ' . $request->request_id,  // Changed from request_id
            'medium' => $request->payment_method,
            'externalId' => $request->request_id  // Changed from request_id
        ];;

        // $data['token'] = $this->token; // Add token to the data array

        $uri = "direct-pay/";
        $response = $this->client->post($uri, [
            "json" => $data,
            "headers" => $this->headers
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        // Extract the reference from the response
        $reference = $responseData['transId'] ?? null;

        // Log the payment details in the payments table
        $payment = new Payment();
        $payment->request_id = $request->request_id;
        $payment->user_id = $this->user->id; //Auth::id();
        $payment->amount = $data['amount'];
        $payment->description = $request->request_id;
        $payment->transaction_id = $reference;
        $payment->payment_method = $data['medium'] ?? null;
        $payment->save();

        return $responseData;
    }

    /**
     * CHECK TRANSACTION STATUS
     * Endpoint to check transaction status after counter is finish
     *
     * @queryParam reference required  Payment reference
     *@request /transaction?reference=REFERENCE
     *@method GET

     */
    public function getTransactionStatus(Request $request)
    {
        $uri = "payment-status/" . $request->reference . "/";
        $response = $this->client->get($uri, [
            "headers" => $this->headers
        ]);

        $response_data = $response->getBody()->getContents();
        $status = json_decode($response_data)?->status;

        if ($status == 'SUCCESSFUL') {
            $payment = Payment::where('transaction_id', $request->reference)->first();
            if ($payment) {
                $payment->status = 'successful';

                // Properly handle the relationship update
                if ($payment->request) {
                    $requestModel = $payment->request;
                    $requestModel->paid = true;
                    $requestModel->save();
                }

                $payment->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment successful'
            ]);
        } else if ($status == 'PENDING') {
            return response()->json([
                'success' => true,
                'message' => 'Payment is still pending. Please wait a moment and try again.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Try again later'
            ]);
        }
    }

    public function withdraw(Request $request)
    {
        $data = [
            'amount' => $request->amount,
            'phone' => $request->phone,
            'message' => $request->message ?? $request->phone . ' withdraw'
        ];
        $uri = "payout/";
        $response = $this->client->post($uri, [
            "json" => $data,
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
            "start" => date_format(new \DateTime($start), "Y-m-d"),
            "end" => date_format(new \DateTime($end), "Y-m-d"),
        ];

        $uri = "history/";
        $response = $this->client->post($uri, [
            "query" => $params,
            "headers" => $this->headers
        ]);

        return $response->getBody()->getContents();
    }

    public function generatePaymentUrl(Request $request)
    {
        $params = $request->all();
        $uri = "initiate-pay/";
        $response = $this->client->post($uri, [
            "json" => $params,
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
