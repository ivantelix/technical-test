<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ResponseExport implements FromArray
{
    protected $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function array(): array
    {
        return $this->value;
    }
}
