<?php

namespace App\Imports;

use App\Pengaduan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI
use Maatwebsite\Excel\Concerns\WithChunkReading; //IMPORT CHUNK READING

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
class PengaduanImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    use Importable;
    protected $import;

     function __construct($import) {
            $this->import = $import;
     }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $i = 0;

        $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->import);
        foreach ($objPHPExcel->getActiveSheet()->getDrawingCollection() as $drawing) {
            if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
        ob_end_clean();
        switch ($drawing->getMimeType()) {
            case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG :
                $extension = 'png';
                break;
            case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_GIF:
                $extension = 'gif';
                break;
            case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_JPEG :
                $extension = 'jpg';
                break;
                }
            } else {
                $zipReader = fopen($drawing->getPath(),'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader,1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();
            }
            $myFileName = '00_Image_'.++$i.'.'.$extension;
            file_put_contents($myFileName,$imageContents);
            // dd($imageContents);
        }
        // dd($imageContents);

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

        // dd($row);
        $pengaduan = new Pengaduan();
        $pengaduan->mesin_id = $row['mesin_id'];
        $pengaduan->lokasi_id = $row['lokasi_id'];
        $pengaduan->user_id = $row['user_id'];
        $pengaduan->status = $row['status'];
        $pengaduan->keterangan = $row['keterangan'];
        $pengaduan->save();

            // Mengambil file yang diupload
                $uploaded_foto = $imageContents;

            // mengambil extension file
                $extension = $extension;

            // membuat nama file random berikut extension
                $filename = md5(time()) . '.' . $extension;
                
            // menyimpan cover ke folder public/img
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
                $uploaded_foto->move($destinationPath, $filename);
            // mengisi field cover di pengaduan dengan filename yang baru dibuat
                $pengaduan->foto = $filename;
                

                $pengaduan->save();
         
        // return new Pengaduan([
        //     'mesin_id' => $row['mesin_id'],
        //     'lokasi_id' => $row['lokasi_id'],
        //     'user_id' => $row['user_id'],
        //     'foto' => $row['foto'],
        //     'status' => $row['status'],
        //     'keterangan' => $row['keterangan'],
        // ]);
        return "ok";
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
