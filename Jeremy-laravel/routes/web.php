<?php

use Illuminate\Support\Facades\Route;
use App\Models\GaugeReading;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/datainput', function () {
    // ini_set('memory_limit', '-1');
    // ini_set('memory_limit', '2048M');

   $file_path = public_path('gauge_readings_1m.csv');
//    $file = fopen($file_path,'r');
//    $data = [];
//    while(($row = fgetcsv($file,null,',')) != false){
//        $data[] = [
//             'log_date' => date('Y-m-d', strtotime($row[0])),
//             'log_time' => $row[1],
//             'gauge_one_reading' => $row[2],
//             'gauge_two_reading' => $row[3],
//             'gauge_one_temperature' => $row[4],
//             'gauge_two_temperature' => $row[5],
//        ];
//    }

//    foreach(array_chunk($data, 1000) as $chunk){
//        GaugeReading::insert($chunk);
//    }

    // while(($row = fgetcsv($file,null,',')) != false){
    //     GaugeReading::create([
    //         'log_date' => date('Y-m-d', strtotime($row[0])),
    //         'log_time' => $row[1],
    //         'gauge_one_reading' => $row[2],
    //         'gauge_two_reading' => $row[3],
    //         'gauge_one_temperature' => $row[4],
    //         'gauge_two_temperature' => $row[5],
    //     ]);
    // }


//    $genaratedeRow = function ($row) {
//        return [
//            'log_date' => date('Y-m-d', strtotime($row[0])),
//            'log_time' => $row[1],
//            'gauge_one_reading' => $row[2],
//            'gauge_two_reading' => $row[3],
//            'gauge_one_temperature' => $row[4],
//            'gauge_two_temperature' => $row[5],
//        ];
//    };


//    DB::statement('SET foreign_key_checks = 0');
//    DB::statement('ALTER TABLE gauge_readings DISABLE KEYS');
//    foreach (App\Helpers\ArrayHelper::chunkFileAnother($file_path, $genaratedeRow, 1000) as $chunk) {
//        GaugeReading::insert($chunk);
//    }
//    DB::statement('SET foreign_key_checks = 1');
//    DB::statement('ALTER TABLE gauge_readings ENABLE KEYS');
    $escaped_file_path = DB::getPdo()->quote($file_path);
    DB::statement("
       LOAD DATA LOCAL INFILE $escaped_file_path
       INTO TABLE gauge_readings
       FIELDS TERMINATED BY ','
       ENCLOSED BY '\"'
       LINES TERMINATED BY '\n'
       (@dummy, log_time, gauge_one_reading, gauge_two_reading, gauge_one_temperature, gauge_two_temperature)
       SET log_date = STR_TO_DATE(@dummy, '%Y-%m-%d');
    ");



   echo "<h1 class='text-center text-2xl background-green-500 text-white'>Success</h1>";
});

