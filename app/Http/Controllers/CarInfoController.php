<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarInfoController extends Controller
{
    public function carInfo(Request $request){
       
        $ApiKey = 'E10D7CDF-307F-4BA1-8501-4544E7125269';

        $url = "https://uk1.ukvehicledata.co.uk/api/datapackage/%s?v=2&api_nullitems=1&key_vrm=%s&auth_apikey=%s";
        $url = sprintf($url, "VehicleData", $request->reg_num, $ApiKey);

      

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return response()->json(['success'=>false]);
        } else {
            return response()->json(['success'=>true,'data'=>json_decode($response,true),'reg_num'=>$request->reg_num]);
        }
    }
}
