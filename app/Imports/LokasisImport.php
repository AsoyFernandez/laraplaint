<?php

namespace App\Imports;
 
use App\Lokasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;

use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI
use Illuminate\Contracts\Queue\ShouldQueue; //IMPORT SHOUDLQUEUE
use Maatwebsite\Excel\Concerns\WithChunkReading; //IMPORT CHUNK READING
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;

use Maatwebsite\Excel\Concerns\SkipsErrors;

class LokasisImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue, WithValidation, SkipsOnError
{
  use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

    public function model(array $row)
    {
       //  foreach($row as $data) {
       //     $row = Lokasi::find($data['nama']);
       //     if (empty($row)) {
       //        return new Lokasi([
       //               'nama' => $data['nama'],
       //               ]);
       //     } 
       // }
        
        return Lokasi::firstOrNew([
            'nama' => $row['nama'],
        ]);
    }

    public function rules(): array
    {
        return [
            
        ];
    }

    //LIMIT CHUNKSIZE
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
