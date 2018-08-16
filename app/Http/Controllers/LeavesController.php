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
use App\leavetypes;
use App\leaves;
use App\contributions;
use Illuminate\Support\Facades\DB;
use App\employee_contributions;
use Response;
use Storage;

class LeavesController extends Controller
{
    public function createleave(){
    	$employees = employees::all();
    	$leavetypes = leavetypes::all();
    	return view('leaves.addleave')->with('employees', $employees)->with('leavetypes', $leavetypes);
    }

    public function submitleave(Request $data){
    	$date = explode(" - ", $data['daterange']);
    	 $getfile = $data['id'].'-'.Carbon::now().'.'.$data['pic']->getClientOriginalExtension();
        $data['pic']->move(public_path('files'), $getfile);
    
    	$leave = new leaves();
    	$leave->employee_id = $data['employeeid'];
    	$leave->leavetype_id = $data['leavetypeid'];
    	$leave->date_applied = Carbon::parse($data['applydate']);
    	$leave->reason = $data['reason'];
        $leave->status = 'PENDING';
    	$leave->date_start = Carbon::parse($date[0]);
    	$leave->date_end = Carbon::parse($date[1]);
    	$leave->file_attachment = $getfile;
    	$leave->save();
         return redirect(route('employees'))->with('success', 'Employee '.$data['idno'].' Added Successfully');
    }

    public function leaves (){
    	$leaves = DB::table('leaves')->join('leavetypes', 'leavetype_id', '=', 'leavetypes.id')->join('employees', 'employee_id', '=', 'employees.id')->select(DB::raw('leaves.*'), 'employees.first_name', 'employees.last_name', 'leavetypes.name')->get();
    	return view('leaves.leaves')->with('leaves', $leaves);
    }

    public function approveleave(Request $data){
        $leave = leaves::where('id', $data['id'])->first();
        $leave->status = 'APPROVED';
        
        if($leave->save()){
            return 'Success';
        }
        else{
            return 'Error';
        }
    }

    public function editleave(Request $id){
        $leave = leaves::where('id',$id->route('id'))->first();
        $employees = employees::all();
        $leavetypes = leavetypes::all();
        return view('leaves.editleave')->with('leave', $leave)->with('employees', $employees)->with('leavetypes', $leavetypes);
    }

 

    public function updateleave(Request $data){
        $date = explode(" - ", $data['daterange']);
        $leave = leaves::find($data['id']);
        $leave->employee_id = $data['employeeid'];
        $leave->leavetype_id = $data['leavetypeid'];
        $leave->date_applied = Carbon::parse($data['applydate']);
        $leave->reason = $data['reason'];
        $leave->status = 'PENDING';
        $leave->date_start = Carbon::parse($date[0]);
        $leave->date_end = Carbon::parse($date[1]);
        if($data['pic'] != null){
            $getimageName =$data['id'].'.'.$data['pic']->getClientOriginalExtension();
           
            if (Storage::exists($getimageName)) {
                    Storage::delete($getimageName);
                }
            $data['pic']->move(public_path('files'), $getimageName);
            $leave->file_attachment = $getimageName;
        }
        $leave->save();
         return redirect(route('leaves'))->with('success', 'Leave Application '.$data['id'].' Updated Successfully');
    }

    public function getleaves(Request $data){
        \Log::info($data);
        $em = leaves::where('employee_id', $data['id'])->get();
        return $em;
    }
}
