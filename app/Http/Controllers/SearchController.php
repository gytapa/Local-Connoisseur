<?php

namespace App\Http\Controllers;

use App\Models\LankytinaVietum;
use App\Models\LankytiosVietosTipai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function displayData()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $API_KEY = "AIzaSyALWBTn0xzhQRPubLtd42yWWMPzRkVqblo";
        $URL_1text = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=food+in+";
        $URL_2text = "&radius=";
        $URL_3text = "&key=AIzaSyALWBTn0xzhQRPubLtd42yWWMPzRkVqblo";
        $photoUrlBase = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=";
        //https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&type=food&key=AIzaSyALWBTn0xzhQRPubLtd42yWWMPzRkVqblo
        $URL_loc1 = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';
        $URL_loc2 = '&type=food';
        $URL_loc3 = '&radius=';
        if (isset($_GET['city'])) {
            $city = Input::get('city');
            $radius = Input::get('radius');
            $options = Input::get('options');
            $location = Input::get('latlng');
            //getting JSON url by city and radius
            //removing spaces
            // if no city has been inputed by hand then use marker
                if (strlen(isset($city))) {
                    $city = str_replace(' ', '+', $city);
                    $url = $URL_1text . $city . $URL_2text . $radius . $URL_3text;
                }
                else
                    $url = $URL_loc1 . $location . $URL_loc3 . $radius . $URL_loc2 .$URL_3text ;
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
                        if (array_key_exists('vicinity', $place))
                            $place = array('name' => $place['name'], 'address' => $place['vicinity'], 'id' => $place['place_id'], 'photo' => $photoUrl );
                            else
                        $place = array('name' => $place['name'], 'address' => $place['formatted_address'], 'id' => $place['place_id'], 'photo' => $photoUrl );
                        $extractedPlaces[$count] = $place;
                        $count++;
                    }
                }
                else
                {

                    if (array_key_exists('vicinity', $place)) {
                      //  $photoUrl = "https://lh3.googleusercontent.com/MPPFasYaJ-m7gU1BgbZQmxC1yCbj1zEKCHZGRgaml8HmPyP_F0wj2nsyh6lLvO0XXkU=w300";
                       if (!isset($photoUrl))
                       {
                           $photoUrl = 'https://www.google.lt/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjCo-bUnbzYAhVjQpoKHRBHD5UQjRwIBw&url=https%3A%2F%2Fcvhci.anthropomatik.kit.edu%2F~bschauer%2Fdatasets%2Fgoogle-512%2Fimages%2Fblack%2Bcolor%2F%3FC%3DS%3BO%3DA&psig=AOvVaw2GyU1XKNgeCkWE7OSsrUNp&ust=1515083945635491';
                       }
                        $_POST['photo'] = $photoUrl;
                        $place = array('name' => $place['name'], 'address' => $place['vicinity'], 'id' => $place['place_id'], 'photo' => $photoUrl);
                    }
                    else
                        $place = array('name' => $place['name'], 'address' => $place['formatted_address'], 'id' => $place['place_id'], 'photo' => $photoUrl );
                    $extractedPlaces[$count] = $place;
                    $count++;
                }
                $photoUrl = "";
            }
            if ($count == 0)
            {
                return view('search')->with(['klaida' =>'Nerasta jokių vietų','places' => $extractedPlaces]);
            }
else {
         foreach ($extractedPlaces as $place)     {
             if (LankytinaVietum::where('id', $place['id'])->count() == 0) {
                 $newPlace = new LankytinaVietum;
                 $newPlace->id = $place['id'];
                 $newPlace->pavadinimas = $place['name'];
                 $myArray = explode(',', $place['address']);
                 $count = count($myArray);
                 //Pašalinam pašto kodą
                 $citySpace = preg_replace('/[0-9]+/', '', $myArray[$count-2]);
                 //Pašalinam tab ir space
                 $city = preg_replace('/\s+/','',$citySpace);
                 $newPlace->miestas = $city;
                 $newPlace->adresas = $place['address'];
                 $newPlace->nuotrauka = $place['photo'];
                 //Tipus reik sutvarkyt paskui :(
                 $newPlace->tipas = 1;

                 $newPlace->save();
             }
         }
    return view('search')->with(['city' => $city, 'radius' => $radius, 'places' => $extractedPlaces]);
}
        }
        else
            return view("search");
    }
}
