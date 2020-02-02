<?php

namespace App\Services;

class PhoneListPerfomer
{
    private $phone_records;

    public function setPhoneRecords($phone_records)
    {
        $this->phone_records = $phone_records;
        return $this;
    }

    public function processPhones()
    {
        $this->removeAllExceptDigits();
        $this->replaceSevenToEightInNumber();
        $this->beautifyFirstName();

        return $this->phone_records;
    }

    private function removeAllExceptDigits()
    {
        foreach ($this->phone_records as $key => $record)
        {
            $this->phone_records[$key]->telephone = preg_replace(
                '/\D/',
                '',
                $this->phone_records[$key]->telephone
            );
        }
    }

    private function replaceSevenToEightInNumber()
    {
        foreach ($this->phone_records as $key => $record)
        {
            if($record->telephone[0] == 7) {
                $record->telephone = '8'.substr($record->telephone, 1);
            }
        }
    }

    private function beautifyFirstName()
    {
        foreach ($this->phone_records as $key => $record)
        {
            $firstname = explode(' ', $record->firstname);
            $firstname = $this->ucfirst_utf8($firstname[0]);
            $this->phone_records[$key]->firstname = $firstname;
        }
    }

    private function ucfirst_utf8($str)
    {
        return mb_substr(mb_strtoupper($str, 'utf-8'), 0, 1, 'utf-8') . mb_substr($str, 1, mb_strlen($str)-1, 'utf-8');
    }
}
