<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class sendSMS{
    private $recipient;
    private $content; 

    public function send($recipient, ?String $content){

        
        $this->content = $content ;
        $this->recipient = $recipient ;

        

        $client = new Client([
            'base_uri' => "http://api.messaging-service.com",
            'headers' => [
                //'Authorization' => "App d473cf628c215f716a99a5b6d621f7b6-436fecab-05b5-4dbe-9cb1-62211fff1489",
                // 'Authorization' => "App 58198d42d41e19d055131c74b405e63b-47c97fd4-fc27-4744-87b9-24be77a95da9",
                'Authorization' => "App 4dca29c5de411c8a4870bec3b1c6a4cd-da7e8bdd-3a4b-46f0-9645-51c0eb123f74",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
        foreach($this->recipient as $k=>$user){
            try {
                $response = $client->request(
                    'POST',
                    'sms/2/text/advanced',
                    [
                        RequestOptions::JSON => [
                            'messages' => [
                                [
                                    'from' => 'ProGuide',
                                    'destinations' => [
                                        ['to' => $user]
                                    ],
                                    'text' => 'Dear '.$k.', '.$this->content,
                                ]
                            ]
                        ],
                    ]
                );
                
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
                
        }  
        return $response;
    }

    
}



