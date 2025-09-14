<?php

namespace App\Helpers;

class ArrayHelper
{
    public static function chunkFile(string $FilePath, callable $chunkSizeGenerator, int $chunkSize)
    {
        $file = fopen($FilePath, 'r');
        $data = [];
        while (($row = fgetcsv($file, null, ',')) !== false) {
            $data[] = $row;
            if (count($data) >= $chunkSize) {
                $chunkSize = $chunkSizeGenerator($data);
                yield $data;
                $data = [];
            }
        }
        yield $data;
        fclose($file);
    }

    //
    public static function chunkFileAnother(string $FilePath, callable $chunkSizeGenerator, int $chunkSize) {
        $file = fopen($FilePath, 'r');
        $data = [];
        for ($ii = 0; ($row = fgetcsv($file, null, ',')) !== false; $ii++) {
            $data[] = $chunkSizeGenerator($row);
            if($ii % $chunkSize == 0 && $ii != 0) {
                yield $data;
                $data = [];
            }
        }
        if(count($data) > 0) {
            yield $data;
        }
        fclose($file);
    }
}
