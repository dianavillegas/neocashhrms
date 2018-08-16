<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\employees;
use App\Branches;
use App\positions;
use App\departments;
use App\areas;
use Carbon\Carbon;
use App\provinces;
use App\contributions;
use App\employee_contributions;
use App\contributionrates;
use Input;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;

class MaatwebsiteController extends Controller
{
   public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        /*$data = Post::get()->toArray();
        return Excel::create('laravelcode', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);*/
    }
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['iso'] = $row['iso'];
                    $data['name'] = $row['name'];
                    $province = provinces::where('iso', $row['iso'])->first();
                    if(!empty($data)) {
                    	if($province == null){
                    		DB::table('provinces')->insert($data);
                    	}
                    	else{
                    		
                    	}
                    }
                }
            });
        }

        Session::put('success', 'Your file was successfully imported to the database!');

        return back();
    }

    public function importemployee(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    
                   $province = provinces::where('name', 'LIKE', '%' . strtolower($row['province']) . '%')->first();
                   $dept = departments::where('name', 'LIKE', $row['dept'] . '%')->first();
                    $position = positions::where('name', 'LIKE', '%' .$row['position'] . '%')->first();
                    $branch = branches::where('name', 'LIKE', $row['branch'].'%')->first();
                    $area = areas::where('name', 'LIKE', '%' . strtolower($row['area']) . '%')->first();
                    /*\Log::info($position['name'].'-'.$row['position']);*/
                    
                    $employees = employees::where('id_no',$row['idno'])->first();
                    $employee = new employees();
                    $employee->id_no = $row['idno'];
                    $employee->first_name = $row['fname'];
                    $employee->middle_name = $row['mname'];
                    $employee->last_name = $row['lname'];
                    $employee->tin = $row['tin'];
                    $employee->position_id = $position['id'];
                    $employee->dept_id = $dept['id'];
                    $employee->branch_id = $branch['id'];
                    $employee->gender = $row['gender'];
                    $employee->birthdate = Carbon::parse($row['bdate']);
                    $employee->age = Carbon::now()->year - Carbon::parse($row['eyear'].'-'.$row['emonth'].'-'.$row['edate'])->year;
                    $employee->employed_date = Carbon::parse($row['eyear'].'-'.$row['emonth'].'-'.$row['edate']);
                    $employee->local_address = $row['homeaddress'];
                    $employee->city_code = $area['id'];
                    $employee->province_code = $province['id'];
                    $employee->zipcode = $area['zipcode'];
                    $employee->emergency_contact = $row['econtact'];
                    $employee->emergency_name = $row['ename'];
                    $employee->emergency_address = $row['eaddress'];
                    $employee->id_pic = $row['idno'].'-'.$row['lname'].'.jpeg';
                    $employee->sign_pic = 'sign'.$row['idno'].'.jpeg'; 
                    $contributions = contributions::all();
                    
                    if(count($reader->toArray()) != 0) {
                    	if($employees == null){
                    		if($employee->save()){
                                $contributions = contributions::all();
                                
                                foreach ($row as $key => $value) {
                                    foreach ($contributions as $contribution) {
                                     if(strcasecmp($key, $contribution['name']) == 0){
                                                    $emc = new employee_contributions();
                                                    $emc->id_no = $row[strtolower($contribution['name'])];
                                                    $emc->contribution_id = $contribution['id'];
                                                    $emc->employee_id = $employee->id;
                                                    $emc->save();
                                                }
                                    }
                                               
                                }
                            }
                    	
                        }
                    }
                    	else{
                    		
                    	}
                    }
                });
        }

        Session::put('success', 'Your file was successfully imported to the database!');

        return back();
    }

    public function importarea(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                   
                   

                    $province = provinces::where('name', 'LIKE', '%' . strtolower($row['province']) . '%')->first();
                    $area = areas::where('zipcode',$row['zipcode'])->first();
                    $data['name'] = $row['name'];
                    $data['zipcode'] = $row['zipcode'];
                    $data['province_id'] = $province['id'];
                    \Log::info($province['id']);
                    if(!empty($data)) {
                        if($area == null){
                            DB::table('areas')->insert($data);
                        }
                        else{

                        }
                       
                        
                    }
                }
            });
        }

        Session::put('success', 'Your file was successfully imported to the database!');

        return back();
    }

    

    public function importcon(Request $request)
    {
       
        if($request->hasFile('import_file')){
            $id = $request['contribution_id'];
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) use($request) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['contribution_id'] = $request['contributionid'];
                    $data['rate_to'] = $row['rate_to'];
                    $data['rate_from'] = $row['rate_from'];
                    $data['er'] = $row['er'];
                    $data['ee'] = $row['ee'];
                    $data['total'] = $row['total'];
                    $con = contributionrates::where('rate_to', $row['rate_to'])->first();
                    if(!empty($row)) {
                        
                            DB::table('contributionrates')->insert($data);
                    }
                    else{

                    }
                }
            });
        }

        Session::put('success', 'Your file was successfully imported to the database!');

        return back();
    }
}
