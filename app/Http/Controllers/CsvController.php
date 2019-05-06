<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function store()
    {
        $file_n = Storage::disk('public')->path('aircraftDatabase.csv');
        $file = fopen('https://opensky-network.org/datasets/metadata/aircraftDatabase.csv', 'r');
        $all_data = array();
        $array = [];
        $headersArray = [];
        $i = 0;
        //$csvColumnHeaders = fgetcsv($file);

        /*
                foreach ($csvColumnHeaders as $key => $value) {
                    array_push($headersArray, $value);

                }


                while ($columns = fgetcsv($file)) {
                    foreach ($columns as $key=> $value) {
                        array_push($array, $all_data['icao24'] = $value);
                            //print_r($all_data);
                    }

                    $combined = array_combine($csvColumnHeaders, $array);
                }


                foreach ($all_data as $key => $value) {
                    //print_r($key);

                }*/
        /* Map Rows and Loop Through Them */
        /*while ($i < 1) {
            $rows = array_map('str_getcsv', file($file_n));
            $header = array_shift($rows);
            $csv = array();
            foreach ($rows as $row) {
                $csv[] = array_combine($header, $row);
            }
        }*/


            //$line[0] = '1004000018' in first iteration
            $headers = fgetcsv($file);

            foreach ($headers as $key => $value) {
                array_push($headersArray, $value);
            }

                //print_r($all_data);
       // echo '<pre>', print_r($headersArray), '</pre>';

        while ($i < 50) {
        $line = fgetcsv($file);

            $comb = array_combine($headersArray, $line);
            echo '<pre>', print_r($comb), '</pre>';
            $i++;
        }

        //echo '<pre>', print_r($line), '</pre>';

            fclose($file);
            }

            //$combined = array_combine($headersArray, $array);
        }


            /*$rows = array_map('str_getcsv', $line);
            $header = array_shift($line);
            foreach($rows as $row) {
            $csv[] = array_combine($header, $row);*/





            /*foreach ($line as $key=>$value) {
                $array[$key] = $value . ' , ';
                print_r($array);
            }*/




        /*for ($i = 0; $i < 10; $i++) {
            $csv[] = array_combine($header, $rows[$i]);
        }
        print_r($csv);*/



        //print_r($combined);
        /* DB::table('planes')->insert(array(

         ));*/



