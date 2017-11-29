<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class SearchController extends Controller
{

    public function displayData()
    {
        $API_KEY = "AIzaSyALWBTn0xzhQRPubLtd42yWWMPzRkVqblo";
        $URL_1text = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=food+in+";
        $URL_2text = "&radius=";
        $URL_3text = "&key=AIzaSyALWBTn0xzhQRPubLtd42yWWMPzRkVqblo";
        $photoUrlBase = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=";
        if (isset($_GET['city'])) {
            $city = Input::get('city');
            $radius = Input::get('radius');
            $options = Input::get('options');
            //getting JSON url by city and radius
            $url = $URL_1text.$city.$URL_2text.$radius.$URL_3text;
            //getting JSON file
            $json = file_get_contents($url);
            $allPlaces = json_decode($json,true);
            //parsing JSON array and getting values that are needed.
            $count = 0;
            $extractedPlaces=array();

            foreach ($allPlaces['results'] as $place)
            {

                $photoUrl2 = "";
                if (array_key_exists('photos', $place)) {
                    foreach ($place['photos'] as $photo) {
                        $photoUrl2 = $photo['photo_reference'];
                        $photoUrl = $photoUrlBase.$photoUrl2.$URL_3text;
                        break;
                    }
                }

                //check if input and form data has same elements
                // if so, add it to the array.
                // if no data was selected just add all places
                if(is_array($options)) {
                    $c = array_intersect($options, $place['types']);
                    if (count($c) > 0) {
                        $place = array('name' => $place['name'], 'address' => $place['formatted_address'], 'id' => $place['place_id'], 'photo' => $photoUrl );
                        $extractedPlaces[$count] = $place;
                        $count++;
                    }
                }
                else
                {

                    $place = array('name' => $place['name'], 'address' => $place['formatted_address'], 'id' => $place['place_id'], 'photo' => $photoUrl );
                    $extractedPlaces[$count] = $place;
                    $count++;
                }
                $photoUrl = "";
            }

            return view('search')->with(['city' => $city, 'radius' => $radius, 'places' => $extractedPlaces]);
        }
        else
            return view("search");
    }
}
