<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MapController extends Controller
{
    public function index()
    {
        return view('roads');
    }
    public function security()
    {
        return view('police');
    }
    public function upcomingprojects()
    {
        return view('projects');
    }
    public function hospitals()
    {
        return view('hospital');
    }
    public function fetchAmenities(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = 1000; // 100 kilometers in meters

        $client = new Client();
        $apiKey = 'AIzaSyDPcXmbNTlOL6p0YwNIpfkZM9xxMn6Vex0';
        
        // Fetch amenities using Places API
        $placesResponse = $client->get("https://maps.googleapis.com/maps/api/place/nearbysearch/json", [
            'query' => [
                'location' => "$latitude,$longitude",
                'radius' => $radius,
                'type' => 'point_of_interest', // Adjust types as needed
                'key' => $apiKey
            ]
        ]);
        $placesData = json_decode($placesResponse->getBody()->getContents(), true);
        
        //Water sources and distribution, Electricity, waste mgt,
        $roadsResponse = $client->get("https://roads.googleapis.com/v1/nearestRoads", [
            'query' => [
                'points' => "$latitude,$longitude",
                'key' => $apiKey
            ]
        ]);
        $roadsData = json_decode($roadsResponse->getBody()->getContents(), true);

        return response()->json([
            'places' => $placesData,
            'roads' => $roadsData
        ]);
    }
}