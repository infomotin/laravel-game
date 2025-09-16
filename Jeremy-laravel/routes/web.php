<?php

use App\Facades\Preferences;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\GaugeReading;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
// use App\Facades\Preferences;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {

    Preferences::set('theme', 'dark');
    $theme = Preferences::get('theme', 'light');
    // dd($theme);


    return Inertia::render('Dashboard',[
        'theme' => $theme,
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
