<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        // Init cURL session
$curl = curl_init();

// Set API Key
// $ApiKey = "123456abcd-12ab-4250-1ab2-abcde123456";

// Construct URL String
$url = "https://uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=bb38df77-8249-4a16-9f06-8a44c456dfbd&key_VRM=KM12AKK";
// $url = sprintf($url, "VehicleData", "KM14AKK", $ApiKey); // Syntax: sprintf($url, "PackageName", "VRM", ApiKey);
// Note your package name here. There are 5 standard packagenames. Please see your control panel > weblookup or contact your account manager

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
  echo "cURL Error: " . $error;
} else {
  var_dump(json_decode($response, true)); // For demonstration purposes - Unserialize response & dump array contents to screen
}
        return view('home',compact('response'));
    }
}
