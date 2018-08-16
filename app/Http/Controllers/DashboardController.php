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
use Input;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
    	$employees = employees::all();
    	$positions = positions::all();
    	$departments = departments::all();
    	$branches = branches::all();
    	$array=  array();
    	$grouped[] ='';
    	$a = 0;
    	$all = DB::table('employees')->join('positions', 'employees.position_id', '=', 'positions.id')->join('departments', 'employees.dept_id', '=', 'departments.id')->join('branches', 'employees.branch_id', '=', 'branches.id')->select(DB::raw('employees.last_name'), DB::raw('branches.name as branch'), DB::raw('positions.name as position'))->get();
        $result = array();
       
            foreach ($all as $a) {
                  $result[$a->branch][$a->position][] =  count($a->last_name);
              }

             
        $bdays = DB::table('employees')->whereMonth('birthdate', '=', Carbon::now()->month)->get();
    	return view('dashboard')->with('employees_count', count($employees))->with('positions_count', count($positions))->with('departments_count', count($departments))->with('branches_count', count($branches))->with('result', $result)->with('positions', $positions)->with('bdays', $bdays);
    }
}


