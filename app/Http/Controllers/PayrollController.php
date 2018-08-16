<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\branches;
use Illuminate\Support\Facades\DB;
use App\employees;
use App\attendance;
use Carbon\Carbon;
use App\payroll;
use App\payroll_line;
class PayrollController extends Controller
{
    public function generatepayroll(){
    	$branches = branches::all();
    	return view('payroll.payroll')->with('branches', $branches);
    }

    public function employeelist(Request $data){
        $date = explode(" - ", $data['daterange']);

        $conded = [];
        //$att=[];
        $dtotal = 0;
       
    	$employees = employees::where('branch_id', $data['id'])->get();
        $att = attendance::rightjoin('employees', 'employee_id', '=','employees.id')
                ->join('positions', 'employees.position_id', '=', 'positions.id')
                ->where('employees.branch_id', $data['id'])
                ->where('date','>=', Carbon::parse($date[0])->toDateString())
                ->where('date', '<=', Carbon::parse($date[1])->toDateString())
                ->select(DB::raw('count(CASE WHEN 0 THEN 0 ELSE attendances.id END) * positions.rate as gross_pay'), DB::raw('employees.id'))
                ->groupBy('employees.id')->get();
       
        $cons = DB::table('employee_contributions')->join('contributions', 'contribution_id', '=', 'contributions.id')->join('employees', 'employee_id', '=','employees.id')->where('employees.branch_id', $data['id'])->select('employees.id', 'employee_contributions.contribution_id', 'contributions.name')->get();
        $cons2='';
        if(Carbon::parse($date[1])->day <= 15){
            $cons2 = DB::table('employee_contributions')
                ->join('contributions', 'employee_contributions.contribution_id', '=', 'contributions.id')
                ->join('employees', 'employee_id', '=','employees.id')
                ->join('contributionrates', 'contributionrates.contribution_id', '=', 'employee_contributions.contribution_id')
                ->join('positions', 'position_id', '=', 'positions.id')
                ->where('employees.branch_id', $data['id'])
                ->where('rate_from', '<=', DB::raw('positions.rate * 26'))
                ->where('rate_to', '>=', DB::raw('positions.rate * 26'))
                ->where('contributions.name', 'PAGIBIG')
                ->select(DB::raw('positions.rate*26 as salary') ,'employees.id','employees.last_name','employees.first_name','employees.id_no','employees.id', DB::raw('SUM(CASE WHEN contributionrates.ee != 0 THEN contributionrates.ee ELSE (positions.rate * 26)*contributionrates.prem_rate END) as deductions'))
                ->groupBy('employees.id')->get();
        }
        else{
            $cons2 = DB::table('employee_contributions')
                ->join('contributions', 'employee_contributions.contribution_id', '=', 'contributions.id')
                ->join('employees', 'employee_id', '=','employees.id')
                ->join('contributionrates', 'contributionrates.contribution_id', '=', 'employee_contributions.contribution_id')
                ->join('positions', 'position_id', '=', 'positions.id')
                ->where('employees.branch_id', $data['id'])
                ->where('rate_from', '<=', DB::raw('positions.rate * 26'))
                ->where('rate_to', '>=', DB::raw('positions.rate * 26'))
                ->where('contributions.name', 'SSS')
                ->where('contributions.name', 'PHILHEATH')
                ->select(DB::raw('positions.rate*26 as salary') ,'employees.id','employees.last_name','employees.first_name','employees.id_no','employees.id', DB::raw('SUM(CASE WHEN contributionrates.ee != 0 THEN contributionrates.ee ELSE (positions.rate * 26)*contributionrates.prem_rate END) as deductions'))
                ->groupBy('employees.id')->get();
        }
        
        foreach ($cons as $key) {
             $rate = employees::join('positions', 'position_id', '=', 'positions.id')->where('employees.id', $key->id)->pluck('positions.rate');

             $conrate = DB::table('contributionrates')->where('contribution_id', $key->contribution_id)->where('rate_from', '<=', $rate[0]*26)->where('rate_to', '>=', $rate[0]*26)->first();
             $r = 0;
             if($conrate->ee == 0){
                $avg = $rate[0]*26;
                $r = $conrate->prem_rate*$avg;
                \Log::info($conrate->prem_rate);
             }
             else{
                $r = $conrate->ee;
             }
            
             $conded[] = array(
                'emp_id' => $key->id,
                'ee' => $r,
                'con' => $key->name,
             );

        }
        $array = [];
        foreach ($att as $a) {
            foreach ($cons2 as $con) {
                if($a->id == $con->id){
                    $array[]=array(
                        'emp_id' => $con->id_no,
                        'id'=>$con->id,
                        'last_name' => $con->last_name,
                        'first_name' => $con->first_name,
                        'gross' => $a->gross_pay,
                        'deductions' => $con->deductions,
                        'net' => $a->gross_pay - $con->deductions
                    );
                }
            }
        }

        foreach ($array as $key) {
            $pay = payroll::where('start_day', Carbon::parse($date[0])->toDateString())->where('end_day', Carbon::parse($date[1])->toDateString())->exists();
            if($pay == 0){
            $payroll = new payroll();
            $payroll->employee_id = $key['id'];
            $payroll->date=Carbon::now();
            $payroll->start_day = Carbon::parse($date[0]);
            $payroll->end_day = Carbon::parse($date[1]);
            $payroll->total_hours = 8;
            $payroll->gross_pay = $key['gross'];
            $payroll->deductions = $key['deductions'];
            $payroll->net_pay = $key['net'];
            $payroll->status = 'DRAFT';
            $payroll->save();
            foreach ($conded as $cond) { 
                if($cond['emp_id'] == $key['id']){
                    $p= new payroll_line();
                    $p->payroll_id = $payroll->id;
                    $p->amount = $cond['ee'];
                    $p->type = 'deductions';
                    $p->description = $cond['con'];
                    $p->save();
                }
            }
            }
        }
         return $array;
    	
}
    public function getpayrolldata(Request $data){
    	$id = employees::where('id_no', $data['id'])->pluck('id');
         $date = explode(" - ", $data['daterange']);
        $earns=[];
        $deds=[];
        $attendance=[];
        $att = attendance::where('employee_id', $id)->get();
        $present = 0;
        $counter = 0;
        $rate = employees::join('positions', 'position_id', '=', 'positions.id')->where('employees.id', $id)->first();
         $pay = payroll::join('employees', 'payrolls.employee_id','=','employees.id')
               ->where('employees.id', $id)
               ->where('start_day',Carbon::parse($date[0]))
               ->where('end_day', Carbon::parse($date[1]))
               ->pluck('status');
        foreach ($att as $key) {
                $counter++;
        }
        $earns[] = array(
            'name' => "Regular Pay",
            'amount' => $rate->rate*$counter,
        );

        $attendance=array(
            'present' => $counter
        );
        
        $avg = $rate->rate*26;
        $cons2='';
         if(Carbon::parse($date[1])->day == 15){
    	$cons2 = DB::table('employee_contributions')
                ->join('contributions', 'employee_contributions.contribution_id', '=', 'contributions.id')
                ->join('employees', 'employee_id', '=','employees.id')
                ->join('contributionrates', 'contributionrates.contribution_id', '=', 'employee_contributions.contribution_id')
                ->join('positions', 'position_id', '=', 'positions.id')
                ->where('employees.id', $id)
                ->where('contributions.name','PAGIBIG')
                ->where('rate_from', '<=', DB::raw('positions.rate * 26'))
                ->where('rate_to', '>=', DB::raw('positions.rate * 26'))
                ->select(DB::raw('positions.rate*26 as salary') , 'contributions.name', DB::raw('CASE WHEN contributionrates.ee != 0 THEN contributionrates.ee ELSE (positions.rate * 26)*contributionrates.prem_rate END as rate'))->get();
       }
       else{
        $cons2 = DB::table('employee_contributions')
                ->join('contributions', 'employee_contributions.contribution_id', '=', 'contributions.id')
                ->join('employees', 'employee_id', '=','employees.id')
                ->join('contributionrates', 'contributionrates.contribution_id', '=', 'employee_contributions.contribution_id')
                ->join('positions', 'position_id', '=', 'positions.id')
                ->where('employees.id', $id)
                ->where('contributions.name','SSS')
                ->where('contributions.name','PHILHEATH')
                ->where('rate_from', '<=', DB::raw('positions.rate * 26'))
                ->where('rate_to', '>=', DB::raw('positions.rate * 26'))
                ->select(DB::raw('positions.rate*26 as salary') , 'contributions.name', DB::raw('CASE WHEN contributionrates.ee != 0 THEN contributionrates.ee ELSE (positions.rate * 26)*contributionrates.prem_rate END as rate'))->get();
       }
       $array = array(
            'earns'=> $earns,
            'cons'=>$cons2,
            'attendance'=>$attendance,
            'status'=>$status

       );

    	return $array;
    }

    public function getpayrolldetails(Request $data){
        return view('payroll.payrollside');
    }

    public function submitpayroll(Request $data){
        $date = explode(" - ", $data['daterange']);
        $pay = payroll::join('employees', 'payrolls.employee_id','=','employees.id')
               ->where('employees.branch_id', $data['employeeid'])
               ->where('start_day',Carbon::parse($date[0]))
               ->where('end_day', Carbon::parse($date[1]))
               ->select('payrolls.*')->get();
       foreach ($pay as $key) {
           $p = payroll::find($key['id']);
           $p->status = 'FINALIZED';
           $p->save(); 
       }
        return $pay;

    }
}

