<?php

use Illuminate\Support\Facades\Route;
use App\Models\GaugeReading;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/datainput', function () {
    // ini_set('memory_limit', '-1');
    ini_set('memory_limit', '2048M');

   $file_path = public_path('gauge_readings_1m.csv');
   $file = fopen($file_path,'r');
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

    while(($row = fgetcsv($file,null,',')) != false){
        GaugeReading::create([
            'log_date' => date('Y-m-d', strtotime($row[0])),
            'log_time' => $row[1],
            'gauge_one_reading' => $row[2],
            'gauge_two_reading' => $row[3],
            'gauge_one_temperature' => $row[4],
            'gauge_two_temperature' => $row[5],
        ]);
    }


   fclose($file);
    echo "Data Inserted";
});

