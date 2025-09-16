<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\GaugeReading;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {

    $startTime = microtime(true);
    // $table->date('log_date');
    // $table->time('log_time');
    // $table->decimal('gauge_one_reading');
    // $table->decimal('gauge_two_reading');
    // $table->decimal('gauge_one_temperature',7,3);
    // $table->decimal('gauge_two_temperature',7,3);

    // $data[] = ['time' => $executionTime];
    $data = [];
    // $data['latest'] = Cache::remember('data.latest', [5, 15], function () {
    //     $chunk1000 =  GaugeReading::orderBy('id', 'desc')->chunk(10, function ($readings) {
    //         $data1 = [];
    //         foreach ($readings as $reading) {
    //             $data1[] = [
    //                 'log_date' => $reading->log_date,
    //                 'log_time' => $reading->log_time,
    //                 'gauge_one_reading' => $reading->gauge_one_reading,
    //                 'gauge_two_reading' => $reading->gauge_two_reading,
    //                 'gauge_one_temperature' => $reading->gauge_one_temperature,
    //                 'gauge_two_temperature' => $reading->gauge_two_temperature,
    //             ];
    //         }
    //         return $data1;
    //     });
    // });

    //get User data
    $data['user_data'] = Cache::remember('data.user_data', [4, 15], function () {
        $user_data = User::all();
        $title = when(true, function () {
            return "User Data";
        }, function () {
            return "No User Data";
        });
        return ['title' => $title, 'data' => $user_data];
    });

    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    $data['time'] = $executionTime;
    return Inertia::render('Dashboard', [
        'gaugeData' => $data
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/datainput', function () {
    // ini_set('memory_limit', '-1');
    // ini_set('memory_limit', '2048M');

    $file_path = public_path('gauge_readings_1m.csv');
    //    $file = fopen($file_path,'r');
    //    $data = [];
    //    while(($row = fgetcsv($file,null,',')) != false){
    //        $data[] = [
    // @@ -29,19 +29,32 @@
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


    $genaratedeRow = function ($row) {
        return [
            'log_date' => date('Y-m-d', strtotime($row[0])),
            'log_time' => $row[1],
            'gauge_one_reading' => $row[2],
            'gauge_two_reading' => $row[3],
            'gauge_one_temperature' => $row[4],
            'gauge_two_temperature' => $row[5],
        ];
    };

    foreach (App\Helpers\ArrayHelper::chunkFileAnother($file_path, $genaratedeRow, 1000) as $chunk) {
        GaugeReading::insert($chunk);
    }
    echo "Data Inserted";
});

require __DIR__ . '/auth.php';
