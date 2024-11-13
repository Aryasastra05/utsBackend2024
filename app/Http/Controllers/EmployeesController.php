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
              'nama pegawai' => $request->name,
              'jenis kelamin pegawai'=> $request->gender,
              'no hp pegawai'=> $request->phone,
              'alamat pegawai'=> $request->address,
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
      public function update($id, Request $request){
        // cari courses berdasarkan id
        $employees = Employees::find($id); // SELECT * FROM courses WHERE id = $id;

        if ($employees) {
            //simpan perubahan
            $employees->update([
             'nama pegawai' => $request->name ?? $employees->name,
                 'jenis kelamin pegawai'=> $request->gender ?? $employees->gender,
                 'no hp pegawai'=> $request->phone ?? $employees->phone,
                 'alamat pegawai'=> $request->address ?? $employees->address,
                 'email pegawai' => $request->email ?? $employees->email,
                 'status pegawai' => $request->status ?? $employees->status,
                 'tanggal masuk kerja' => $request->hired_on ?? $employees->hired_on,
                 
             
            ]);
            $data = [
             'message' => 'Data Berhasil Diupdate',
             'data' => $employees
         ];
         return response()->json($data, 200);
            
        }else{
            $data = [
                'message' => 'Data tidak diubah',
                
            ];
            return response()->json($data, 404);
        }







    }
     public function destroy($id){
        // cari courses berdasarkan id
        $employees = Employees::find($id); // SELECT * FROM courses WHERE id = $id;

        if($employees){
            $data = [
                'message' => 'Data Berhasil Dihapus',
                'data' => $employees
            ];
    
            // hapus courses
            $employees->delete();
    
            return response()->json($data, 200);

        }else{
            $data = [
                'message' => 'Data tidak ditemukan',
                
            ];
            return response()->json($data, 404);
        }

        

    }
}
