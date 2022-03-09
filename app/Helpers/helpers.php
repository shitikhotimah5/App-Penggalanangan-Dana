<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

if (! function_exists('upload')) {
    function upload($directory, $file, $filename = "")
    {
        $extensi = $file->getClientOriginalExtension();
        $filename = "{$filename}_" . date('Ymdhis') . ".{$extensi}";

        // simpan gambar
        Storage::disk('public')->putFileAs("/$directory", $file, $filename);

        return "/$directory/$filename";
    }
}
