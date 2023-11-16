<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PokemonManager
{
    public function loadFile(UploadedFile $file, $targetDir){
        $fileName = uniqid().'.'.$file->guessExtension();
        $file->move($targetDir, $fileName);

        return $fileName;
    }
}