<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Cache;



class EmployeeController extends Controller
{
    public function cache(){

//         $employees = Cache::remember('employees.all', 60*60, function() {
//     // ye function tabhi chalega jab cache me data na ho
//     return Employee::all();
// });
   // $employees = Employee::all();

//    $employees =  Cache::put('employees.all', $employees, 60*60); // 1 hour

//    $employees = Cache::get('employees.all');



//  if ($employees) {
//     echo "Cache Data Count: " . count($employees);
// } else {
//     echo "Cache empty hai";
// }

//  $employees = Cache::forget('employees.all');

//   $employees = Cache::get('employees.all');

//  if ($employees) {
//     echo "Cache Data Count: " . count($employees);
// } else {
//     echo "Cache empty hai";
// }



/////////chunk 
//✔ Chunk

//Bulk email

//Bulk update/delete

//Export files
//but ye data  direct ui pr nhi lata hai 

// Employee::chunk(20, function ($employees) {
//     foreach ($employees as $employee) {
//         echo $employee->name . "<br>";
//     }
// });

//Cursor

 //Huge data stream

//Background processing

//Queue jobs
//$employee  = Employee::find(2)->delete();

//$employee  = Employee::withTrashed()->get();

//$employee  = Employee::onlyTrashed()->get();

//$employee  = Employee::withTrashed()->find(2)->restore();

  $employee  = Employee::withTrashed()->find(2)->forceDelete();


dd($employee);

// foreach (Employee::cursor() as $employee) {
//     echo $employee->name."<br>";
// }






 //dd($emp);
}




}
