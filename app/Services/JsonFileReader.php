<?php

namespace App\Services;

class JsonFileReader
{
    public function readJson(string $path_from_public) {
        return json_decode(
            file_get_contents(public_path($path_from_public))
        );
    }
}
