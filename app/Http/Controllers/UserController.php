<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
{
    public function index(){
        $data = array(
            'title'            => 'Data User',
            'menuAdminUser'    => 'active',
            'user'             => User::orderBy('jabatan','asc') 
                                  ->orderBy('name', 'asc')->get(),
        );
        return view('admin/user/index',$data);
    }

    public function admin()
    {
        $data = array(
            'title'            => 'Data Admin',
            'menuAdminUser'    => 'active',
            'user'             => User::where('jabatan', 'Admin')
                                    ->orderBy('name', 'asc')
                                    ->get(),
        );

        return view('admin/user/index', $data);
    }

    public function karyawan()
    {
        $data = array(
            'title'            => 'Data Karyawan',
            'menuAdminUser'    => 'active',
            'user'             => User::where('jabatan', 'karyawan')
                                    ->orderBy('name', 'asc')
                                    ->get(),
        );

        return view('admin/user/index', $data);
    }

    public function ditugaskan()
    {
        $data = [
            'title' => 'Karyawan Yang Sedang Ditugaskan',
            'menuAdminUser' => 'active',
            'user' => User::where('jabatan', 'Karyawan')
                        ->where('is_tugas', true)
                        ->orderBy('name', 'asc')
                        ->get(),
        ];

        return view('admin.user.index', $data);
    }

    public function belumtugas()
    {
        $data = [
            'title' => 'Karyawan Yang Sedang Ditugaskan',
            'menuAdminUser' => 'active',
            'user' => User::where('jabatan', 'Karyawan')
                        ->where('is_tugas', false)
                        ->orderBy('name', 'asc')
                        ->get(),
        ];

        return view('admin.user.index', $data);
    }

    public function create(){
        $data = array(
            'title'            => 'Tambah Data User',
            'menuAdminUser'    => 'active',
        );
        return view('admin/user/create',$data);
    }

    public function store(Request $request){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'jabatan'   => 'required',
            'password'  => 'required|confirmed|min:8',
        ],[
            'name.required'        =>'Nama Tidak Boleh Kosong',
            'email.required'       =>'Email Tidak Boleh Kosong',
            'email.unique'         =>'Email Sudah Digunakan',
            'jabatan.required'     =>'Jabatan Harus Di Pilih',
            'password.required'    =>'Password Tidak Boleh Kosong',
            'password.confirmed'   =>'Password Tidak Sesuai',
            'password.min'         =>'Password Minimal 8 Karakter',
        ]);

        $user = new User;
        $user->name         =$request->name;
        $user->email        =$request->email;
        $user->jabatan      =$request->jabatan;
        $user->password     = Hash::make($request->password);
        $user->is_tugas     = false;
        $user->save();

        return redirect()->route('user')->with('success','Data Berhasil Ditambahkan');
    }

    public function edit($id){
        $data = array(
            'title'            => 'Edit Data User',
            'menuAdminUser'    => 'active',
            'user'             => User::findOrFail($id),
        );
        return view('admin/user/edit',$data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email', $id,
            'jabatan'   => 'required',
            'password'  => 'nullable|confirmed|min:8',
        ],[
            'name.required'        =>'Nama Tidak Boleh Kosong',
            'email.required'       =>'Email Tidak Boleh Kosong',
            'email.unique'         =>'Email Sudah Digunakan',
            'jabatan.required'     =>'Jabatan Harus Di Pilih',
            'password.required'    =>'Password Tidak Boleh Kosong',
            'password.confirmed'   =>'Password Tidak Sesuai',
            'password.min'         =>'Password Minimal 8 Karakter',
        ]);

        $user = User::with('tugas')->findOrFail($id);
        $user->name         =$request->name;
        $user->email        =$request->email;
        $user->jabatan      =$request->jabatan;
        if ($request->jabatan=='Admin'){
            $user->is_tugas = false;
            $user->tugas()->delete();
        }
        if ($request->filled('password')){
            $user->password     = Hash::make($request->password);
        }
        $user->save();

            return redirect()->route('user')->with('success','Data Berhasil Di Edit');
    }
    
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success','Data Berhasil Di Hapus');
    }


    public function exportExcel()
    {
        $users = User::orderBy('jabatan', 'asc')
                    ->orderBy('name', 'asc')
                    ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Data User');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue(
            'A2',
            'Di Cetak : ' . now()->format('d-m-Y')
        );
        $sheet->mergeCells('A3:E3');
        $sheet->setCellValue(
            'A3',
            ' Jam : ' . now()->format('H.i.s')
        );

        // Header
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama');
        $sheet->setCellValue('C4', 'Email');
        $sheet->setCellValue('D4', 'Jabatan');
        $sheet->setCellValue('E4', 'Status');

        $row = 5;
        $no = 1;

        foreach ($users as $user) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $user->name);
            $sheet->setCellValue('C'.$row, $user->email);
            $sheet->setCellValue('D'.$row, $user->jabatan);
            $sheet->setCellValue('E'.$row, $user->is_tugas ? 'Sudah Ditugaskan' : 'Belum Ditugaskan');

            $row++;
        }

            // Header tebal
            $sheet->getStyle('A4:E4')->getFont()->setBold(true);
            $sheet->getStyle('A4:E4')->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('D9D9D9');
            $sheet->getStyle('A4:E4')->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            // Lebar kolom otomatis
            foreach (range('A', 'E') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

            // Border semua tabel
            $sheet->getStyle('A4:E'.($row-1))
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );
            $writer = new Xlsx($spreadsheet);

            $filename = 'Data_User_' . now()->format('d-m-Y_H-i-s') . '.xlsx';

            return response()->streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, $filename);
    }

    public function exportPdf()
    {
        $users = User::orderBy('jabatan', 'asc')
                    ->orderBy('name', 'asc')
                    ->get();

        $pdf = Pdf::loadView('admin.user.pdf', [
            'users' => $users,
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'Data_User_' . now()->format('d-m-Y_H-i-s') . '.pdf'
        );
    }
}
