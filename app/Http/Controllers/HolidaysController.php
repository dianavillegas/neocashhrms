<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\holidays;
use App\holidaytypes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;


class HolidaysController extends Controller
{
    public function createholiday(){
    	$holidaytypes = holidaytypes::all();
    	return view('holidays.addholiday')->with('holidaytypes', $holidaytypes);
    }

    public function submitholiday(Request $data){
        $h = holidays::whereDate('date', Carbon::parse($data['date']))->get();
        if($h == '[]'){
            $holiday = new holidays(); 
            $holiday->name = $data['name'];
            $holiday->date = Carbon::parse($data['date']);
            $holiday->holidaytype_id = $data['holidaytypeid'];
            $holiday->scope = $data['level'];
            if($data['level'] == 'NATIONAL'){
               $holiday->area = 'PHILIPPINES';
            }
            else{
                $holiday->area = $data['area'];
            }
            $holiday->save();
            return redirect(route('holidays'))->with('success', 'Holiday '.$data['name'].' Added Successfully');
        }
        else{
            return redirect(route('holidays'))->with('error', 'Another holiday with same date is already saved to the database');
        }
    	
    }

    public function holidays (){
      
        return view('holidays.holidays');
    }

    public function getholiday(Request $data){
         $holidays = DB::table('holidays')->join('holidaytypes','holidaytype_id','=','holidaytypes.id')->whereMonth('holidays.date',Carbon::parse($data['month'])->month)->whereYear('holidays.date',$data['year'])->select(DB::raw('holidays.*'), DB::raw('holidaytypes.name as type'))->get();
         return $holidays;
    }

    public function editholiday(Request $data){
        $holiday = holidays::find($data->route('id'));
        $holidaytypes = holidaytypes::all();
        return view('holidays.editholiday')->with('holiday', $holiday)->with('holidaytypes', $holidaytypes);;
    }

    public function updateholiday(Request $data){
         $holiday = holidays::find($data['id']);
        $holiday->name = $data['name'];
        $holiday->date = $data['date'];
        $holiday->holidaytype_id = $data['holidaytypeid'];
        $holiday->scope = $data['level'];
        if($data['level'] == 'NATIONAL'){
               $holiday->area = 'PHILIPPINES';
            }
            else{
                $holiday->area = $data['area'];
            }
            $holiday->save();
        return redirect(route('holidays'))->with('success', 'Holiday '.$data['name'].' Updated Successfully');
    }

    public function get(){
         $response = Curl::to('https://holidayapi.com/v1/holidays?key=5ea50e3d-ee44-43b8-843a-b89955a2159b&country=PH&year=2017')->get();
         $holidays = json_decode($response, TRUE);
         /*foreach ($holidays['holidays'] as $holiday) {
             foreach ($holiday as $h) {
                 return $h['name'];
             }
         }*/
        return json_decode($response, TRUE);
    }
   
}
