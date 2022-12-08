<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;


class CsvController extends Controller
{


    public function store()
    {

        $manuf = DB::table('aircraftDatabase')->where('icao24', 'aa3487')->first();
        foreach ($manuf as $key=>$value) {
            echo $key . " " . $value . "\n";
        }

        $file_n = Storage::disk('public')->path('aircraftDatabase.csv');
        $file = fopen('https://opensky-network.org/datasets/metadata/aircraftDatabase.csv', 'r');
        $all_data = array();
        $array = [];
        $headersArray = [];
        $i = 0;
        $headers = fgetcsv($file);

        foreach ($headers as $key => $value) {
            array_push($headersArray, $value);
        }

        while ($i < 50) {
            $line = fgetcsv($file);
            $comb = array_combine($headersArray, $line);
            $comb = array_combine($headersArray, $line);
            $i++;
        }

        fclose($file);
    }

    public function getPlanes($id)
    {
        //$manuf = DB::table('aircraftDatabase')->where('icao24', $id)->first();
        $manuf = DB::select('call getPlanes(?)',array($id));
        if($manuf) {
            $manufJson = json_encode($manuf);
            return $manufJson;
        } else {
            echo "no such plane";
        }
        echo "\n";
            $client = new Client();
            $res = $client->get('https://opensky-network.org/api/states/all?icao24=' . $id);
            $json = $res->getBody()->getContents();
            return $json;
    }

    public function getAllPlanes() {
        $client = new Client();
        $res = $client->get('https://opensky-network.org/api/states/all');
        $json = $res->getBody()->getContents();
        return $json;
    }
}



