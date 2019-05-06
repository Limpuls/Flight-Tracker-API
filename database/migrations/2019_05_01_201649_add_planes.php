<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;





class AddPlanes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*$file_n = Storage::disk('public')->path('aircraftDatabase2.csv');
        $file = fopen($file_n, "r");
        $array = [];

        $csvColumnHeaders = fgetcsv($file);
        //var_dump($csvColumnHeaders[0]);

        while ($columns = fgetcsv($file)) {
            foreach ($columns as $key=> $value) {
                array_push($array, $value);
                DB::table('planes')->insert(array(
                    'icao24' => $value,
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
                ));
            }
        }
        print_r($array);*/

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
            //echo '<pre>', print_r($comb['icao24']), '</pre>';
            DB::table('planes')->insert(array(
                'icao24' => $comb['icao24'],
                /*'registration' => $comb['registration'],*/
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));

            DB::table('manufacturer')->insert(array(
                'name' => $comb['manufacturername'],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));

            /*DB::table('owner')->insert(array(
                'name' => $comb['owner'],
                'reg_until' => $comb['reguntil'],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));*/

            DB::table('engine')->insert(array(
                'name' => $comb['engines'],
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
            $i++;
        }

        //echo '<pre>', print_r($line), '</pre>';

        fclose($file);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
