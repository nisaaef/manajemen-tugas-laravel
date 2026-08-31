<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TugasController extends Controller
{
    public function index(){
        $user = Auth::user();

        if($user->jabatan=='Admin'){
        $data = array(
            'title'            => 'Data Tugas',
            'menuAdminTugas'    => 'active',
            'tugas'             => Tugas::with('user')->get(),
        );
        return view('admin/tugas/index',$data);}
        else{
        $data = array(
            'title'            => 'Data Tugas',
            'menuKaryawanTugas'    => 'active',
            'tugas'                => Tugas::with('user')
        ->where('user_id', $user->id)->first(),
        );
        return view('karyawan/tugas/index',$data);
        }
    }

    public function create(){
         $data = array(
            'title'            => 'Tambah Data Tugas',
            'menuAdminTugas'    => 'active',
            'user'              => User::where('jabatan','karyawan')
                                    ->where('is_tugas',false)->get(),
        );
        return view('admin/tugas/create',$data);
    }

        public function store(Request $request){
        $request->validate([
            'user_id'               => 'required',
            'tugas'                 => 'required',
            'tanggal_mulai'         => 'required',
            'tanggal_selesai'       => 'required',
        ],[
            'user_id.required'              =>'Nama Tidak Boleh Kosong',
            'tugas.required'                =>'Tugas Tidak Boleh Kosong',
            'tanggal_mulai.required'        =>'Tanggal Mulai Tidak Boleh Kosong',
            'tanggal_selesai.required'      =>'Tanggal Selesai Tidak Boleh Kosong',
        ]);

        $user = User::findOrFail($request->user_id);
        $tugas = new Tugas;
        $tugas->user_id             = $request->user_id;
        $tugas->tugas               = $request->tugas;
        $tugas->tanggal_mulai       = $request->tanggal_mulai;
        $tugas->tanggal_selesai     = $request->tanggal_selesai;
        $tugas->save();
        $user->is_tugas = true;
        $user->save();

        return redirect()->route('tugas')->with('success','Data Tugas Berhasil Ditambahkan');
    }

    public function edit($id){
         $data = array(
            'title'             => 'Edit Data Tugas',
            'menuAdminTugas'    => 'active',
            'tugas'             => Tugas ::with('user')->findOrFail($id),
            'user'              => User::all(),
        );
        return view('admin/tugas/update',$data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'tugas'                 => 'required',
            'tanggal_mulai'         => 'required',
            'tanggal_selesai'       => 'required',
        ],[
            'tugas.required'                =>'Tugas Tidak Boleh Kosong',
            'tanggal_mulai.required'        =>'Tanggal Mulai Tidak Boleh Kosong',
            'tanggal_selesai.required'      =>'Tanggal Selesai Tidak Boleh Kosong',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->tugas               = $request->tugas;
        $tugas->tanggal_mulai       = $request->tanggal_mulai;
        $tugas->tanggal_selesai     = $request->tanggal_selesai;
        $tugas->save();

        return redirect()->route('tugas')->with('success','Data Berhasil Di Perbarui');
    }

    public function destroy($id){
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();
        $user = User::where('id',$tugas->user_id)
        ->first();
        $user->is_tugas = false;
        $user->save();
        return redirect()->route('tugas')->with('success','Data Tugas Berhasil Di Hapus');
    }

    public function exportExcel()
{
    $tugas = Tugas::with('user')
                    ->orderBy('id', 'asc')
                    ->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul
    $sheet->mergeCells('A1:E1');
    $sheet->setCellValue('A1', 'DATA TUGAS');

    $sheet->mergeCells('A2:E2');
    $sheet->setCellValue('A2', 'Di Cetak : ' . now()->format('d-m-Y'));

    $sheet->mergeCells('A3:E3');
    $sheet->setCellValue('A3', 'Jam : ' . now()->format('H:i:s'));

    // Style Judul
    $sheet->getStyle('A1:A3')->getAlignment()
        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $sheet->getStyle('A1')->getFont()
        ->setBold(true)
        ->setSize(16);

    // Header
    $sheet->setCellValue('A4', 'No');
    $sheet->setCellValue('B4', 'Nama');
    $sheet->setCellValue('C4', 'Tugas');
    $sheet->setCellValue('D4', 'Tanggal Mulai');
    $sheet->setCellValue('E4', 'Tanggal Selesai');

    // Style Header
    $sheet->getStyle('A4:E4')->getFont()->setBold(true);
    $sheet->getStyle('A4:E4')->getFill()
        ->setFillType(Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('D9D9D9');

    $sheet->getStyle('A4:E4')->getAlignment()
        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
        ->setVertical(Alignment::VERTICAL_CENTER);

    // Isi Data
    $row = 5;
    $no = 1;

    foreach ($tugas as $item) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $item->user->name);
        $sheet->setCellValue('C' . $row, $item->tugas);
        $sheet->setCellValue('D' . $row, $item->tanggal_mulai);
        $sheet->setCellValue('E' . $row, $item->tanggal_selesai);

        $row++;
    }

    // Border
    $sheet->getStyle('A4:E' . ($row - 1))
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

    // Auto Size
    foreach (range('A', 'E') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'Data_Tugas_' . now()->format('d-m-Y_H-i-s') . '.xlsx';

    return response()->streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, $filename);
    }

    public function exportPdf()
{
    $user = Auth::user();

    if($user->jabatan=='Admin'){
        $tugas = Tugas::with('user')
                ->where('user_id', $user->id)
                ->first();

    $pdf = Pdf::loadView('admin.tugas.pdf', [
        'tugas' => $tugas,
        'tanggal' => now()->format('d-m-Y'),
        'jam' => now()->format('H.i.s'),
    ]);

    $pdf->setPaper('A4', 'landscape');

    return $pdf->download(
        'Data_Tugas_' . now()->format('d-m-Y_H-i-s') . '.pdf'
    );
    } else{
            $tugas = Tugas::with('user')
                    ->where('user_id', $user->id)
                    ->first();

    $pdf = Pdf::loadView('karyawan.tugas.pdf', [
        'tanggal' => now()->format('d-m-Y'),
        'jam' => now()->format('H.i.s'),
        'tugas' => $tugas,
    ]);

    $pdf->setPaper('A4', 'landscape');

    return $pdf->download(
        'Data_Tugas_' . now()->format('d-m-Y_H-i-s') . '.pdf'
    );
    }
}
}