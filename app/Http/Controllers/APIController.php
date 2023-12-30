<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Locale;

class APIController extends Controller
{
    //https://www.youtube.com/watch?v=MdIfZJ08g2I&ab_channel=Andy%27sTechTutorials
    //https://openweathermap.org/forecast5
    
    
    public function callAPI($lat=49.28 ,$lon=-123.12 ){
            
      
        $api="api.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$lon."&appid=68d8fe1c8bfd9697f58434fea53c7057";
     
        $weather= Http::get($api)->json();
       

    //visability
        $iCantSee='';
        if($weather['list'][0]['visibility'] >750 ){
            $iCantSee=" being able to see every thing";
        }elseif($weather['list'][0]['visibility'] <750 && $weather['list'][0]['visibility'] >250  ){
            $iCantSee=" seeing most things";
        }elseif($weather['list'][0]['visibility'] <250){
            $iCantSee=" with a guide dog";
        }
        $iCantSee.=" because of a visisibity of ".$weather['list'][0]['visibility']." /1000";

    //gust speed
        $gust="";
        if(doubleval( $weather['list'][0]['wind']['gust']) >15 ){
            $gust=" maybe do a etransfer";
        }elseif(doubleval( $weather['list'][0]['wind']['gust']) <15 && doubleval( $weather['list'][0]['wind']['gust'])  >7  ){
            $gust=" fly a kite on the way there?";
        }elseif(doubleval( $weather['list'][0]['wind']['gust']) <7 ){
            $gust=" practically no wind to hold you back from making big $ moves ";
        }
        $gust.=" with a gust of ".$weather['list'][0]['wind']['gust']." Km/H";

       

    //data dict
        $str="Go to the bank in ".$weather['city']['name'].$iCantSee.$gust;
        $viewData=[
            'sub_title'=>  "Api Location Weather Search",
            'title'=>  "meeting Requirement",
            'content'=>$str,
            
        ];


        //return view('test');
        return view('API/showAPI')->with('viewData',$viewData);
    }


    // i wasent able to get it to search these locations so i think the user wont either
    public function add(Request $data){
        $location= new location();
        $location->longitude=$data->input('longitude');
        $location->latitude=$data->input('latitude');

        $api="api.openweathermap.org/data/2.5/forecast?lat=".$location->longitude."
        &lon=".$location->latitude."&appid=68d8fe1c8bfd9697f58434fea53c7057";
     
        $weather= Http::get($api)->json();

        foreach($weather as $test ){
            echo $test;
        }
        //$location->name= $weather['city']['name'];
    
        location::validate($data); //check if the name is unique 
        $location->save();


        return back();
    }

}
