<?php

namespace App\Http\Controllers;

use App\Services\CsvFilePerformer;
use App\Services\JsonFileReader;
use App\Services\PhoneListPerfomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request, JsonFileReader $reader, PhoneListPerfomer $phone, CsvFilePerformer $file)
    {
        $phone_records = $reader->readJson('files/phones.json');

        $file_contents = $file->perform($phone, $phone_records);

        Storage::put(
            'file.csv',
            $file_contents
        );

        return response()->download(storage_path('app/file.csv'));
    }
}
