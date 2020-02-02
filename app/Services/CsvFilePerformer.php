<?php

namespace App\Services;

use League\Csv\Writer;

class CsvFilePerformer
{
    public function perform($phone_performer, $phone_records)
    {
        $writer = Writer::createFromString();
        foreach($phone_performer->setPhoneRecords($phone_records)->processPhones() as $record)
        {
            $writer->insertOne([
                'Name' => $record->firstname,
                'Phone' => $record->telephone
            ]);
        }

        return mb_convert_encoding($writer->getContent(), 'windows-1251');
    }
}
