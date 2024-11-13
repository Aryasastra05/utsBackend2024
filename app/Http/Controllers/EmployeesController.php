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
        if(!$request->has('name', 'gender', 'phone', 'address', 'email', 'status', 'hired_on')){
          $data = [
              'message' => 'Data Gagal Di tambahkan',
              
          ];
          return response()->json($data,404);
      
        } else {
          $input =[
              'name' => $request->name,
              'gender'=> $request->gender,
              'phone'=> $request->phone,
              'address'=> $request->address,
              'email' => $request->email,
              'status' => $request->status,
              'hired_on' => $request->hired_on,
              
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
             'name' => $request->name ?? $employees->name,
                 'gender'=> $request->gender ?? $employees->gender,
                 'phone'=> $request->phone ?? $employees->phone,
                 'address'=> $request->address ?? $employees->address,
                 'email' => $request->email ?? $employees->email,
                 'status' => $request->status ?? $employees->status,
                 'hired_on' => $request->hired_on ?? $employees->hired_on,
                 
             
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
    public function show($id){
        $employees = Employees::find($id);
        if ($employees){
            $data= [
             'message' => 'Menampilkan detail Data',
             'data' => $employees
         ];
         return response()->json($data, 200);
 
         }else{
             $data = [
                 'message' => 'Data tidak ditemukan',
                 
             ];
             return response()->json($data, 404);
         }
     }

     public function search ( $name){
        $employees =  Employees::find('name','like','%'.$name.'%')->get();
        
        if ($employees){
            $data= [
             'message' => 'Menampilkan detail Data',
             'data' => $employees
         ];
         return response()->json($data, 200);
 
         }else{
             $data = [
                 'message' => 'Data tidak ditemukan',
                 
             ];
             return response()->json($data, 404);
         }
 
}

public function active ( ){
    $employees =  Employees::find('name','active')->get();

        $data= [
         'message' => 'Menampilkan detail Data',
         'data' => $employees
     ];
     return response()->json($data, 200);

}

public function inactive ( ){
    $employees =  Employees::find('name','inactive')->get();

        $data= [
         'message' => 'Menampilkan detail Data',
         'data' => $employees
     ];
     return response()->json($data, 200);

}

public function terminated ( ){
    $employees =  Employees::find('name','terminated')->get();

        $data= [
         'message' => 'Menampilkan detail Data',
         'data' => $employees
     ];
     return response()->json($data, 200);

}
}