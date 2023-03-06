<?php

namespace App\Services;

class FileService{

    public function upload($file)
    {
        $name = $file->getClientOriginalName();
        $path = storage_path() . '/app/logos/';
        $file->move($path, $name);
        return '/logos/' . $name;
    }
}