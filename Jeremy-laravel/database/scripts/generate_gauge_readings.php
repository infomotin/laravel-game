<?php

// Configuration
$outputFile = 'gauge_readings_1m.csv';
$totalRows = 1000000;
$batchSize = 10000; // Process in batches to manage memory usage

// Open output file
$file = fopen($outputFile, 'w');
if (!$file) {
    die("Error: Could not create output file\n");
}

// Write CSV header
fputcsv($file, [
    'log_date',
    'log_time',
    'gauge_one_reading',
    'gauge_two_reading',
    'gauge_one_temperature',
    'gauge_two_temperature'
]);

// Progress tracking
$startTime = microtime(true);
$lastUpdate = 0;

// Generate data in batches
for ($i = 0; $i < $totalRows; $i += $batchSize) {
    $batchData = [];
    $currentBatchSize = min($batchSize, $totalRows - $i);
    
    for ($j = 0; $j < $currentBatchSize; $j++) {
        // Generate random date between 2023-01-01 and 2025-12-31
        $randomDays = mt_rand(0, 1095); // 3 years range
        $date = (new DateTime('2023-01-01'))->add(new DateInterval("P{$randomDays}D"))->format('Y-m-d');
        
        // Generate random time
        $hours = str_pad(mt_rand(0, 23), 2, '0', STR_PAD_LEFT);
        $minutes = str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);
        $seconds = str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);
        $time = "$hours:$minutes:$seconds";
        
        // Generate random gauge readings (0.00 to 100.00)
        $gaugeOne = number_format(mt_rand(0, 10000) / 100, 2);
        $gaugeTwo = number_format(mt_rand(0, 10000) / 100, 2);
        
        // Generate random temperatures (-20.000 to 50.000)
        $tempOne = number_format(mt_rand(-20000, 50000) / 1000, 3);
        $tempTwo = number_format(mt_rand(-20000, 50000) / 1000, 3);
        
        $batchData[] = [
            $date,
            $time,
            $gaugeOne,
            $gaugeTwo,
            $tempOne,
            $tempTwo
        ];
    }
    
    // Write batch to file
    foreach ($batchData as $row) {
        fputcsv($file, $row);
    }
    
    // Show progress
    $progress = (($i + $currentBatchSize) / $totalRows) * 100;
    $elapsed = microtime(true) - $startTime;
    $rowsPerSecond = ($i + $currentBatchSize) / $elapsed;
    
    if (time() - $lastUpdate >= 1) { // Update every second
        echo sprintf("Progress: %.2f%% | Rows: %d/%d | Speed: %.0f rows/s\r",
            $progress,
            $i + $currentBatchSize,
            $totalRows,
            $rowsPerSecond
        );
        $lastUpdate = time();
    }
}

// Close file
fclose($file);

// Show completion message
$totalTime = microtime(true) - $startTime;
echo "\nCSV file generated successfully: $outputFile\n";
echo "Total time: " . number_format($totalTime, 2) . " seconds\n";
echo "Average speed: " . number_format($totalRows / $totalTime, 0) . " rows/second\n";
