<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\competencies;
use App\competencytypes;
use App\indicators;
use App\positions;
use App\departments;
use App\employees;
use App\position_competencies;
use App\assessment_record;
use App\employee_assessment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompetencyController extends Controller
{

    public function createcoms(){
    	$coms = competencytypes::all();
    	return view('competencies.addcompetency')->with('coms', $coms);
  	}
    public function submitcoms(Request $data){

       $coms = new competencies();
       $coms->name = $data['name'];
       $coms->competencytype_id = $data['comid'];
       $coms->save();

       return redirect(route('competencies'))->with('success', 'Competency '.$coms->name.' Saved Successfully');  
    }

    public function competencies(){
      $coms = DB::table('competencies')->join('competencytypes', 'competencytype_id','=', 'competencytypes.id')->select(DB::raw('competencies.*'), DB::raw('competencytypes.name as type'))->get();
      return view('competencies.competencies')->with('coms', $coms);
    }

    public function editcoms($id){
      $coms = competencies::where('id',$id)->first();
      $comts = competencytypes::all();
      return view('competencies.editcompetency')->with('coms', $coms)->with('comts', $comts);;
    }

    public function updatecoms(Request $data){
      //return $data->all();
       $coms = competencies::find($data['id']);
        $coms->name = $data['name'];
       $coms->competencytype_id = $data['comid'];
       $coms->save();
       return redirect(route('competencies'))->with('success', 'Competency '.$coms->name.' Updated Successfully');
    }

    public function setindicator(){
      $coms = competencies::all();
      $positions = positions::all();
      $indicators = indicators::all();
    	return view('indicators.setindicator')->with('coms',$coms)->with('positions', $positions)->with('indicators', $indicators);
    }

    public function submitset(Request $data){
      $coms = competencies::all();
      $position = positions::where('id', $data['positionid'])->pluck('name');
      foreach ($data->all() as $key => $value) {
          foreach ($coms as $com) {
            if($com['name'][0].$com['id'] == $key){
              if($value == 'Yes'){
                $pc = position_competencies::where('position_id', $data['positionid'])->where('compentency_id',$com['id'])->get();
                if(count($pc) == 0){
                   $pc = new position_competencies();
                   $pc->position_id = $data['positionid'];
                   $pc->compentency_id = $com['id'];
                   $pc->save();
                }
              }
              
            }
          }
        }
         
            return redirect(route('indicatorlist'))->with('success', 'Competencies for '.$position.' Has Updated Successfully');
      
      
      
    }

    public function indicatorlist(){
      $departments = departments::all();
      $positions = positions::all();
      return view('indicators.indicatorslist')->with('departments', $departments)->with('positions', $positions);
    }
    public function getlist(Request $data){
      $coms = DB::table('position_competencies')->join('competencies','compentency_id', '=', 'competencies.id')->select(DB::raw('competencies.*'))->where('position_id', $data['id'])->get();
        return $coms;
    }

    public function editlist(Request $data){
      $coms = competencies::all();
      $positions = positions::all(); 
      $ps =  DB::table('position_competencies')->join('positions','position_id', '=', 'positions.id')->select(DB::raw('distinct positions.*'))->get();
      $pc = DB::table('competencies')->select('*',DB::raw('(CASE WHEN id in(select distinct compentency_id from position_competencies where position_id = '.$data->route('id').') THEN 1 ELSE 0 END) as status'))->get();
     
      return view('indicators.setindicator')->with('coms',$coms)->with('positions', $positions)->with('pc', $pc)->with('position_id', $data->route('id'))->with('ps', $ps);
    }

    public function setemployee(Request $data){
     $employees = employees::all();
     return view('competencies.employeeassessment')->with('employees', $employees);
    }

    public function getemployee(Request $data){
     $datas=[];
       $em = employees::where('id', $data['id'])->pluck('position_id');
      $positions = positions::all(); 
      $ps =  DB::table('position_competencies')->join('positions','position_id', '=', 'positions.id')->select(DB::raw('distinct positions.*'))->get();
      $datas['pc'] = DB::table('competencies')->select('*',DB::raw('(CASE WHEN id in(select distinct compentency_id from position_competencies where position_id = '.$em[0].') THEN 1 ELSE 0 END) as status'))->get();
      $datas['ind'] = indicators::all();
      return $datas;
    }

    public function submitemployee (Request $data){
      $ar = new assessment_record();
      $ar->employee_id = $data['employeeid'];
      $ar->evaluated_by = 1;
      $date = explode("-", $data['summarydate']);
      $ar->summary_date = Carbon::parse($date[0].'-01-'.$date[1]);
      $ar->save();

        $coms = competencies::all();
      $position = positions::where('id', $data['positionid'])->pluck('name');
      foreach ($data->all() as $key => $value) {
          foreach ($coms as $com) {
            if($com['name'][0].$com['id'] == $key){
              $emc = new employee_assessment();
              $emc->ar_id = $ar->id;
              $emc->competency_id = $com['id'];
              $emc->indicator_id = $value;
              $emc->comments="ok";
              $emc->save();
            }
          }
        }
    }

    public function viewemp(Request $request){
      $data = [];
      $data['ar'] = DB::table('assessment_records as c')->join('employees as a', 'c.employee_id','=', 'a.id')->leftjoin('employees as b', 'c.evaluated_by','=', 'b.id')->select('a.first_name as emp_first','a.last_name as emp_last', 'a.middle_name as emp_mid', 'c.summary_date','c.id', 'b.last_name as evl', 'b.middle_name as evm', 'b.first_name as evf')->where('c.employee_id', $request['id'])->get();
      return $data['ar'];
    }

    public function viewemployee(){
      $employees = employees::all();
      return view('competencies.employeeviewcom')->with('employees', $employees);
    }

    public function getemp(Request $data){
      $emc = DB::table('employee_assessments')->join('competencies', 'competency_id', '=', 'competencies.id')->join('indicators', 'indicator_id','=','indicators.id')->join('assessment_records', 'ar_id','=','assessment_records.id')->select('competencies.name as comp','competencies.competencytype_id', 'indicators.name as ind', 'assessment_records.summary_date', 'assessment_records.created_at')->where('employee_assessments.ar_id', $data['id'])->get();
      return $emc;
    }
}

