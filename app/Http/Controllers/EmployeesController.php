<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
class EmployeesController extends Controller
{
    public function index(){
        //
        //query builder student = DB::('students)=>get
        $employeess =Employees::all(); //menggunakan eloquent
       
        if ($employeess->isEmpty()) {
            
            $data = [
                'message' => 'Data tidak ditemukan',
                
            ];
        }else {
            $data = [
                'message' => 'Data Berhasil DI akses',
                'data' => $employeess
            ];

        }
        return response()->json($data, 200);

    }

    public function store(Request $request){
        if(!$request->has('nama', 'nim', 'jurusan', 'email')){
          $data = [
              'message' => 'Data Gagal Di tambahkan',
              
          ];
          return response()->json($data,404);
      
      } else {
          $input =[
              'nama pegawai' => $request->nama,
              'jenis kelamin pegawai'=> $request->gender,
              'no hp pegawai'=> $request->phone,
              'alamat pegawai'=> $request->addres,
              'email pegawai' => $request->email,
              'status pegawai' => $request->status,
              'tanggal masuk kerja' => $request->hired_on,
          ];
          $employees = Employees::create($input);
          $data = [
              'message' => 'Data Berhasil Ditambah',
              'data' => $employees
          ];
          return response()->json($data,200);
  
      }
         
      }
}
