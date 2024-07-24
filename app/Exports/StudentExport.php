<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {

        return [
            'S.N','Student Name','Email','Address','Date of Birth','Contact','Gender','Father Name','Father Contact','Mother Name','Mother Contact','Previous College'
        ];
    }
}
