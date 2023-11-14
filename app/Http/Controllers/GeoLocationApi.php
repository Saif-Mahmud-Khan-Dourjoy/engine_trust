<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoLocationApi extends Controller
{
    public function coordinate(Request $request){
        $url = "https://api.distancematrix.ai/maps/api/geocode/json?address=".$request->postCode."&key=oNeOmPGSuXfwxYgxC6NufyuqbFCMdMeV4zGbPaYIlGGJ4vE9asmJ9oOZXn0R9OeC";
            
        $curl = curl_init();
        // Create array of options for the cURL session
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        ));
        
        // Execute cURL session and store the response in $response
        $response = curl_exec($curl);
        
        // If the operation failed, store the error message in $error
        $error = curl_error($curl);
        
        // Close cURL session
        curl_close($curl);
        
        // If there was an error, print it to screen. Otherwise, unserialize response and print to screen.
        if ($error) {
          return response()->json(['success'=>false]);
        } else {
        //  header('Content-Type: application/json');
           $json = json_decode($response, true);

           return response()->json(['success'=>true,'data'=>$json]);
        }
    }
    public function distance(Request $request){
        $url = "https://api.distancematrix.ai/maps/api/distancematrix/json?origins=".$request->lat1.",".$request->lng1."&destinations=".$request->lat2.",".$request->lng2."&key=n9jgnZ5A8Pg43VCQvUCNe3YqBCabnmOQyKKFmVfoKo1QcUn08FX9sTBKPo7pjtLT";
            
        $curl = curl_init();
        // Create array of options for the cURL session
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        ));
        
        // Execute cURL session and store the response in $response
        $response = curl_exec($curl);
        
        // If the operation failed, store the error message in $error
        $error = curl_error($curl);
        
        // Close cURL session
        curl_close($curl);
        
        // If there was an error, print it to screen. Otherwise, unserialize response and print to screen.
        if ($error) {
          return response()->json(['success'=>false]);
        } else {
        //  header('Content-Type: application/json');
           $json = json_decode($response, true);

           return response()->json(['success'=>true,'data'=>$json]);
        }
    }
}
