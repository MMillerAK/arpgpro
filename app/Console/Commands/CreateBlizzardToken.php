<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateBlizzardToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:CreateToken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $APICLIENT= env('BLIZZARD_API_CLIENT', false);
    $APISECRET= env('BLIZZARD_API_SECRET', false);

   $params = array(
    'grant_type' =>'client_credentials'
    
   );

    $url = "https://us.api.blizzard.com/d3/data/act?locale=en_US";

    $tokenUri = "https://oauth.battle.net/token";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_USERPWD, $APICLIENT . ":" . $APISECRET);
    curl_setopt($ch, CURLOPT_URL, $tokenUri);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

    $response = curl_exec($ch);
    curl_close($ch);

    $accessTokenResponse = json_decode($response, true);


    
   if(isset($accessTokenResponse['access_token']))
   {
    $status = 'ok';
    $message = 'message generated';
   }
   else
   {
    $status = 'not okay';
    $message = "token not generated";
    echo "fail";
    die;
   }
   
   $token = $accessTokenResponse['access_token'];
   $arr[] = array(
    'message' => $message,
    'Status' => $status,
    'token' => $token
    
    );

   //$arr['Status'] = $status;
   //$arr['message'] = $M;

   
   var_dump( arr);
    }
}
