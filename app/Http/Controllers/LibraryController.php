<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branches;
use App\positions;
use App\departments;
use App\areas;
use App\provinces;
use App\indicators;
use App\allowancetypes;
use App\allowancerates;
use Illuminate\Support\Facades\DB;
class LibraryController extends Controller
{
    	public function createbranch(){
		return view('branches.addbranch');
	}

    public function submitbranch(Request $data){
       $branch = new Branches();
       $branch->name = $data['name'];
       $branch->address = $data['address'];
       $branch->save();

       return redirect(route('branches'))->with('success', 'Branch '.$branch->name.' Saved Successfully');  
    }

    public function branches(){
    	$branches = Branches::all();
    	return view('branches.branches')->with('branches', $branches);
    }

    public function editbranch($id){
    	$branch = Branches::where('id',$id)->first();
    	return view('branches.editbranch')->with('branch', $branch);
    }

    public function updatebranch(Request $data){
       $branch = Branches::find($data['id']);
       $branch->name = $data['name'];
       $branch->address = $data['address'];
       $branch->save();
       return redirect(route('branches'))->with('success', 'Branch '.$branch->name.' Updated Successfully');
    }

    public function createposition(){
   	$departments = departments::all();
    return view('positions.addposition')->with('departments', $departments);
  }
    public function submitposition(Request $data){
       $position = new positions();
       $position->name = $data['name'];
       $position->description = $data['description'];
       $position->department_id = $data['deptid'];
       $position->rate = $data['rate'];
       $position->save();

       return redirect(route('positions'))->with('success', 'position '.$position->name.' Saved Successfully');  
    }

    public function positions(){
      $positions = positions::all();
      return view('positions.positions')->with('positions', $positions);
    }

    public function editposition($id){
      $position = positions::where('id',$id)->first();
      $departments = departments::all();
      return view('positions.editposition')->with('position', $position)->with('departments', $departments);
    }

    public function updateposition(Request $data){
      //return $data->all();
       $position = positions::find($data['id']);
       $position->name = $data['name'];
       $position->description = $data['description'];
       $position->department_id = $data['deptid'];
       $position->save();
       return redirect(route('positions'))->with('success', 'position '.$position->name.' Updated Successfully');
    }

   public function createdept(){
    return view('departments.adddept');
  }
    public function submitdept(Request $data){
       $dept = new departments();
       $dept->name = $data['name'];
       $dept->description = $data['description'];
       $dept->save();

       return redirect(route('departments'))->with('success', 'Department '.$dept->name.' Saved Successfully');  
    }

    public function departments(){
      $departments = departments::all();
      return view('departments.departments')->with('departments', $departments);
    }

    public function editdept($id){
      $dept = departments::where('id',$id)->first();
      return view('departments.editdept')->with('dept', $dept);
    }

    public function updatedept(Request $data){
      //return $data->all();
       $dept = departments::find($data['id']);
       $dept->name = $data['name'];
       $dept->description = $data['description'];
       $dept->save();
       return redirect(route('departments'))->with('success', 'Department '.$dept->name.' Updated Successfully');
    }

   public function createprovince(){
   	$departments = departments::all();
    return view('provinces.addprovince')->with('departments', $departments);
  }
    public function submitprovince(Request $data){
       $province = new provinces();
       $province->iso = $data['iso'];
       $province->name = $data['name'];
       $province->save();

       return redirect(route('provinces'))->with('success', 'province '.$province->name.' Saved Successfully');  
    }

    public function provinces(){
      $provinces = provinces::all();
      return view('provinces.provinces')->with('provinces', $provinces);
    }

    public function editprovince($id){
      $province = provinces::where('id',$id)->first();
      $departments = departments::all();
      return view('provinces.editprovince')->with('province', $province)->with('departments', $departments);
    }

    public function updateprovince(Request $data){
      //return $data->all();
       $province = provinces::where('id',$data['id'])->first();
       $province->iso = $data['iso'];
       $province->name = $data['name'];
       $province->save();
       return redirect(route('provinces'))->with('success', 'province '.$province->name.' Updated Successfully');
    }

    public function createarea(){
    $provinces = provinces::all();
    return view('areas.addarea')->with('provinces', $provinces);
  }
    public function submitarea(Request $data){
       $area = new areas();
       $area->zipcode = $data['zip'];
       $area->name = $data['name'];
       $area->province_id = $data['provinceid'];
       $area->save();

       return redirect(route('areas'))->with('success', 'Area '.$area->name.' Saved Successfully');  
    }

    public function areas(){
      $areas = DB::table('areas')->join('provinces', 'province_id', '=', 'provinces.id')->select(DB::raw('areas.id'), DB::raw('areas.name'), DB::raw('areas.zipcode'), DB::raw('provinces.name as province'))->get();
      return view('areas.areas')->with('areas', $areas);
    }

    public function editarea($id){
      $area = areas::where('id',$id)->first();
       $provinces = provinces::all();
      return view('areas.editarea')->with('area', $area)->with('provinces', $provinces);
    }

    public function updatearea(Request $data){
      //return $data->all();
       $area = areas::where('id',$data['id'])->first();
       $area->zipcode = $data['zip'];
       $area->name = $data['name'];
       $area->province_id = $data['provinceid'];
       $area->save();
       return redirect(route('areas'))->with('success', 'area '.$area->name.' Updated Successfully');
    }

     public function createindicator(){
    return view('indicators.addindicator');
  }
    public function submitindicator(Request $data){
       $indicator = new indicators();
       $indicator->name = $data['name'];
       $indicator->save();

       return redirect(route('indicators'))->with('success', 'Department '.$indicator->name.' Saved Successfully');  
    }

    public function indicators(){
      $indicators = indicators::all();
      return view('indicators.indicators')->with('indicators', $indicators);
    }

    public function editindicator($id){
      $indicator = indicators::where('id',$id)->first();
      return view('indicators.editindicator')->with('indicator', $indicator);
    }

    public function updateindicator(Request $data){
      //return $data->all();
       $indicator = indicators::find($data['id']);
       $indicator->name = $data['name'];
       $indicator->save();
       return redirect(route('indicators'))->with('success', 'Department '.$indicator->name.' Updated Successfully');
    }

    public function createallowancetype(){
      return view('allowances.addallowance');
    }
    public function submitallowancetype(Request $data){
       $allowancetype = new allowancetypes();
       $allowancetype->name = $data['name'];
       $allowancetype->save();

       return redirect(route('allowancetypes'))->with('success', 'Department '.$allowancetype->name.' Saved Successfully');  
    }

    public function allowancetypes(){
      $allowancetypes = allowancetypes::all();
      return view('allowances.allowances')->with('allowancetypes', $allowancetypes);
    }

    public function editallowancetype($id){
      $positions = positions::all();
      $allowancetype = allowancetypes::where('id',$id)->first();
      $data = allowancerates::where('allowancetype_id', $id)->join('positions', 'position_id', '=', 'positions.id')->select('positions.*', 'allowancerates.*')->get();
      return view('allowances.editallowance')->with('allowancetype', $allowancetype)->with('positions', $positions)->with('data', $data);
    }

    public function updateallowancetype(Request $data){
     
      $allowancetype = allowancetypes::find($data['id']);
       $allowancetype->name = $data['name'];
       $allowancetype->save();
      $positions = positions::all();
      $pos = $data->input();
        foreach ($positions as $position) {
          foreach ($pos as $p => $value) {
            $v = str_replace('_',' ',$p);
            if(strcasecmp($v, $position['name']) == 0){
              $ex = allowancerates::where('position_id', $position['id'])->where('allowancetype_id', $data['id'])->pluck('id');
              \Log::info($ex);
              if($ex == '[]'){
                $al = new allowancerates();
                $al->allowancetype_id = $data['id'];
                $al->position_id = $position['id'];
                $al->rate = $value;
                if($value == '0.00'){
                  $al->status = 0;
                }
                else{
                  $al->status = 1;
                }
                $al->save();
              }
              else{
                $al = allowancerates::where('id',$ex)->first();
                $al->allowancetype_id = $data['id'];
                $al->position_id = $position['id'];
                $al->rate = $value;
                if($value == '0.00'){
                  $al->status = 0;
                }
                else{
                  $al->status = 1;
                }
                $al->save();
              }
              
            }
          }
        }
     
       return redirect(route('allowancetypes'))->with('success', 'Allowance '.$allowancetype->name.' Updated Successfully');
    }

}
