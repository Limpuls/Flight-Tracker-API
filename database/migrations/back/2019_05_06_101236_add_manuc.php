<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            // Look up manuf to see if we already inserted it.
            // Hopefully name isn't duplicated
            $manuf = DB::table('manufacturer')->where('name', $comb['manufacturername'])->first();
            // Only insert if it isn't already there
            if ( ! $manuf ) {
                $manufId = DB::table('manufacturer')->insertGetId(array(
                    'name' => $comb['manufacturername'],
                ));
            } else {
                $manufId = $manuf->id;
            }

            DB::table('planes')->insert(array(
                'icao24' => $comb['icao24'],
                'manufacturer_name' => $manufId
            ));
            /*






            DB::table('planes')->insert(array(
                'icao24' => $comb['icao24'],

                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));*/
            $i++;
        }
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
