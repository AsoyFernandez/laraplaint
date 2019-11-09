<?php

namespace App\Imports;

use App\Pengaduan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI
use Maatwebsite\Excel\Concerns\WithChunkReading; //IMPORT CHUNK READING

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
class PengaduanImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $count = count(Pengaduan::all()) + 1;
        $car = \Carbon\Carbon::now();
        $bulan = "I";
        $tahun = substr($car->year, -2);
        if ($car->month == 1) {
            $bulan = $bulan;
        }elseif ($car->month == 2) {
            $bulan = "II";
        }elseif ($car->month == 3) {
            $bulan = "III";
        }elseif ($car->month == 4) {
            $bulan = "IV";
        }elseif ($car->month == 5) {
            $bulan = "V";
        }elseif ($car->month == 6) {
            $bulan = "VI";
        }elseif ($car->month == 7) {
            $bulan = "VII";
        }elseif ($car->month == 8) {
            $bulan = "VIII";
        }elseif ($car->month == 9) {
            $bulan = "IX";
        }elseif ($car->month == 10) {
            $bulan = "X";
        }elseif ($car->month == 11) {
            $bulan = "XI";
        }elseif ($car->month == 12) {
            $bulan = "XII";
        }
        $no_pengaduan = "LP-$count/SKJ/$bulan/$tahun";

        dd($row);
        // return new Pengaduan([
        //     'mesin_id' => $row['mesin_id'],
        //     'lokasi_id' => $row['lokasi_id'],
        //     'user_id' => $row['user_id'],
        //     'foto' => $row['foto'],
        //     'status' => $row['status'],
        //     'keterangan' => $row['keterangan'],
        // ]);
    }

    public function rules(): array
    {
        return [
            // 'mesin_id' => 'required|exists:mesins,id',
            // 'lokasi_id' => 'required|exists:lokasis,id',
            // 'user_id' => 'required|exists:users,id',
            // 'foto' => 'required',
        ];
    }

        //LIMIT CHUNKSIZE
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
