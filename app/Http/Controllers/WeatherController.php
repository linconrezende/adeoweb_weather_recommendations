<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    function getForecastArea($city, $type = 'long-term') {
        // List of location forecasts
        //https://api.meteo.lt/v1/places/vilnius/forecasts

        $result = new \stdClass();
        //Weather forecast for the area
        try {
            $result = $this->fetchWeather($city, $type);
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }
    
    private function fetchWeather($city, $type) {
        $path = "https://api.meteo.lt/v1/places/$city/forecasts/$type";
        $result = array();
        $result["errorCode"] = -1;
        $result["shortURL"] = null;
        $result["errorMessage"] = null;
        $result["weather"] = null;

        //We need to set a context with ignore_errors on otherwise PHP doesn't fetch page content for failure HTTP status codes
        $opts = array("http" => array("ignore_errors" => true));
        $context = stream_context_create($opts);

        $response = @file_get_contents($path, false, $context);
        if(!isset($http_response_header))
        {
            $result["errorMessage"] = "Local error: Failed to fetch API page";
            throw new \Exception($result["errorMessage"], $result["errorCode"]);
        }

        //Hacky way of getting the HTTP status code from the response headers
        if (!preg_match("{[0-9]{3}}", $http_response_header[0], $httpStatus))
        {
            $result["errorMessage"] = "Local error: Failed to extract HTTP status from result request";
            throw new \Exception($result["errorMessage"], $httpStatus[0]);
        }

        $errorCode = -1;
        switch($httpStatus[0])
        {
            case 200:
                $errorCode = 0;
                break;
            case 400:
                $errorCode = 1;
                break;
            case 406:
                $errorCode = 2;
                break;
            case 502:
                $errorCode = 3;
                break;
            case 503:
                $errorCode = 4;
                break;
            case 404:
                $errorCode = 5;
                break;
        }

        if($errorCode == -1)
        {
            $result["errorMessage"] = "$$httpStatus[0] Local error: Unexpected response code received from server";
            throw new \Exception($result["errorMessage"], $httpStatus[0]);
        }

        $result["errorCode"] = $errorCode;
        if($errorCode == 0)
            $result["weather"] = $response;
        else
            $result["errorMessage"] = $response;

        if($result["weather"]) {
            return $result["weather"];
        } else
        {
            throw new \Exception($result["errorMessage"], $httpStatus[0]);
        }
    }
}
