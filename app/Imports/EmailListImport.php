<?php

namespace App\Imports;

use App\Models\EmailList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class EmailListImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     return new EmailList([
    //         //
    //     ]);
    // }

    public $data;

    public function collection(Collection $rows)
    {
        // Store the data for processing in the controller
        $this->data = $rows;
    }
}
