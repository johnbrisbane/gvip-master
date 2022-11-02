<?php defined('BASEPATH') OR exit('No direct script access allowed');

use GViP\Curl;

class GoogleGeocoder
{
    public function __construct()
    {
        $this->baseURL = "https://maps.googleapis.com/maps/api/geocode/json";
    }

    public function geocode($address)

    {
        $CI =& get_instance();
       $key = $CI->config->item('google_cloud_key');

        $url = $this->baseURL . "?address=" . urlencode($address) . "&key=" . $key;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        curl_close($ch);

        if ($contents) {
            $resp = json_decode($contents);
            if($resp->status = 'OK'){
                return $resp;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function reverseGeocode($location)
    {
        $url = $this->baseURL . "&latlng=" . $location;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        curl_close($ch);

        if ($contents) {
            $resp = json_decode($contents);
            if($resp->status = 'OK'){
                return $resp->results[0]->formatted_address;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

?>
