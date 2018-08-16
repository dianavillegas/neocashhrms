<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\DB;
use Storage;

class EmployeesController extends Controller
{
    public function createemployee(){
    	$branches = branches::all();
    	$positions = positions::all();
    	$departments = departments::all();
    	$areas = areas::all();
    	$provinces = provinces::all();
    	return view('employees.addemployee')->with('branches', $branches)->with('positions', $positions)->with('departments', $departments)->with('areas', $areas)->with('provinces', $provinces);
    }

    public function getpositions(Request $id){
    	$positions = positions::where('department_id',$id['id'])->get();
    	return $positions;
    }

    public function getzip(Request $id){
    	$areas = areas::where('id',$id['id'])->get();
    	return $areas;
    }

    public function submitemployee(Request $data){

    	
        $getimageName =$data['idno'].'-'.$data['lastname'].'.'.$data['pic']->getClientOriginalExtension();
        $data['pic']->move(public_path('images'), $getimageName);
        $sign = 'sign'.$data['idno'].'.'.$data['sign']->getClientOriginalExtension();
        $data['sign']->move(public_path('images'), $sign);
    	
    	$employee = new employees();
    	$employee->id_no = $data['idno'];
    	$employee->first_name = $data['firstname'];
    	$employee->middle_name = $data['middlename'];
    	$employee->last_name = $data['lastname'];
    	$employee->tin = $data['tin'];
    	$employee->position_id = $data['positionid'];
    	$employee->dept_id = $data['deptid'];
    	$employee->branch_id = $data['branchid'];
    	$employee->gender = $data['gender'];
    	$employee->birthdate = Carbon::parse($data['bdate']);
    	$employee->age = $data['age'];
    	$employee->employed_date = Carbon::parse($data['employeddate']);
    	$employee->local_address = $data['localadd'];
    	$employee->city_code = $data['area_id'];
    	$employee->province_code = $data['prov_id'];
    	$employee->emergency_contact = $data['econtact'];
    	$employee->emergency_name = $data['efname'];
    	$employee->emergency_address = $data['eaddress'];
    	$employee->id_pic = $getimageName;
    	$employee->sign_pic = $sign; 
    	if($employee->save()){
    		$contributions = contributions::all();
    		$cons = $data->input();
    		foreach ($contributions as $contribution) {
    			foreach ($cons as $con => $value) {
    				if(strcasecmp($con, $contribution['name']) == 0){
    					$emc = new employee_contributions();
    					$emc->id_no = $value;
    					$emc->contribution_id = $contribution['id'];
    					$emc->employee_id = $employee->id;
    					$emc->save();
    				}
    			}
    		}
    	}
    	 return redirect(route('employees'))->with('success', 'Employee '.$data['idno'].' Added Successfully');
    }

    public function employees(){
    	 $result = DB::table('employees')->join('branches', 'branch_id', '=', 'branches.id')->join('positions', 'position_id','=','positions.id')->select(DB::raw('employees.id_no'),DB::raw('employees.first_name'),DB::raw('employees.middle_name'), DB::raw('employees.last_name'),DB::raw('branches.name'), DB::raw('positions.name as position'), DB::raw('employees.id'))->get();
    	 $employees = json_decode($result, true);
    	 return view('employees.employees')->with('employees', $employees);
    }

    public function editemployee($id){
        $employees = employees::where('id', $id)->first();
        $contributions = DB::table('contributions')->join('employee_contributions', 'contribution_id','=','contributions.id')->get();
        $array= array();
        foreach ($contributions as $contribution) {
               if($contribution->employee_id == $id){
                    $array[$contribution->name]=$contribution->id_no;   
               }
            }
        $branches = branches::all();
        $positions = positions::all();
        $departments = departments::all();
        $areas = areas::all();
        $provinces = provinces::all();
        //return $array['SSS'];
        return view('employees.editemployee')->with('branches', $branches)->with('positions', $positions)->with('departments', $departments)->with('areas', $areas)->with('provinces', $provinces)->with('employees', $employees)->with('array',$array);
    }

    public function updateemployee(Request $data){
        //return $data->all();

        
        $employee = employees::find($data['id']);
        $employee->id_no = $data['idno'];
        $employee->first_name = $data['firstname'];
        $employee->middle_name = $data['middlename'];
        $employee->last_name = $data['lastname'];
        $employee->tin = $data['tin'];
        $employee->position_id = $data['positionid'];
        $employee->dept_id = $data['deptid'];
        $employee->branch_id = $data['branchid'];
        $employee->gender = $data['gender'];
        $employee->birthdate = Carbon::parse($data['bdate']);
        $employee->age = $data['age'];
        $employee->employed_date = Carbon::parse($data['employeddate']);
        $employee->local_address = $data['localadd'];
        $employee->city_code = $data['area_id'];
        $employee->province_code = $data['prov_id'];
        $employee->emergency_contact = $data['econtact'];
        $employee->emergency_name = $data['efname'];
        $employee->emergency_address = $data['eaddress'];

        if($data['pic'] != null){
            $getimageName =$data['firstname'].'-'.$data['lastname'].'.'.$data['pic']->getClientOriginalExtension();
            $data['pic']->move(public_path('images'), $getimageName);
            if (Storage::exists($getimageName)) {
                    Storage::delete($getimageName);
                }
            $employee->id_pic = $getimageName;
        }
        if($data['sign'] != null){
             $sign = $data['firstname'].'sign'.$data['lastname'].'.'.$data['sign']->getClientOriginalExtension();
            $data['sign']->move(public_path('images'), $sign);
            if (Storage::exists($sign)) {
                    Storage::delete($sign);
                }
            $employee->sign_pic = $sign; 
        }

        else if($data['pic'] == null || $data['pic'] == null){

        }
       
        
        if($employee->save()){
            $contributions = contributions::all();
            $cons = $data->input();
            foreach ($contributions as $contribution) {
                foreach ($cons as $con => $value) {
                    if(strcasecmp($con, $contribution['name']) == 0){
                        $emc = new employee_contributions();
                        $emc->id_no = $value;
                        $emc->contribution_id = $contribution['id'];
                        $emc->employee_id = $employee->id;
                        $emc->save();
                    }
                }
            }
        }
         return redirect(route('employees'))->with('success', 'Employee '.$data['idno'].' Added Successfully');
    }
}
