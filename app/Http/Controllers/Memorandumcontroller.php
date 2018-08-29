<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\employees;
use App\memorandums;
use Carbon\Carbon;


class memorandumcontroller extends Controller
{

	// create memorandum
	public function creatememofunction()
	{
      	 $query = DB::select('select id,memotype from memotypes order by memotype');
        $query1 = DB::select('select id,name from branches order by name');
		return view('memorandums.creatememorandum')->with('list',$query)->with('branch',$query1);
	}

	public function getidfunction()
	{
		 $query2 = DB::select('select employees.id as No,id_no as ID_No,first_name as FirstName,last_name as LastName, positions.name as Position,departments.name as Department from employees
				join positions on employees.position_id = positions.id
				join departments on employees.dept_id = departments.id
         order by employees.last_name');
			 return $query2;
	}

	public function getarrayfunction(Request $data)
	{
		$sample = DB::table('employees')->join('positions','employees.position_id','=','positions.id')->join('departments','employees.dept_id','=','departments.id')->whereIn('branch_id',$data['array'])->select('employees.id as No','employees.id_no as ID_No','first_name','last_name','positions.name as Position','departments.name as Department')->get();
		return $sample;
	}
	public function sendmemofunction(Request $data)
	{
		$dt = Carbon::parse($data['memodate']);
		$timenow = Carbon::now();
		$vartime = Carbon::parse($timenow);
		DB::insert('insert into memorandums(subject,dates,description,attachments,datecreated,memotype_id) values(?,?,?,?,?,?)', [$data['subjecttext'],$dt,$data['description'],$data['attachment'],$vartime,$data['memotypecmb']]);
		$lastid = DB::select('select id from memorandums order by id desc limit 1');

		foreach ($lastid as $key) {
			foreach ($data['array1'] as $ids) {
			DB::insert('insert into memorecipients(memorandum_id,employee_id,status) values(?,?,?)',[$key->id,$ids,'SUCCESS']);
				}
		}
		return $data;
	}
	//ViewingMemos

	public function viewmemofunction()
	{
		$query = DB::table('memorandums')->join('memotypes', 'memorandums.memotype_id', '=', 'memotypes.id')->select(DB::raw('memorandums.id'), DB::raw('memorandums.subject'), DB::raw('memotypes.memotype'), DB::raw('memorandums.dates'), DB::raw('substr(memorandums.description, 1, 50) as description'),DB::raw('memorandums.attachments'), DB::raw('memorandums.datecreated'))->get();
		return view('memorandums.viewmemorandum')->with('rawquery', $query);
	}
	//editmemo

	public function editmemofunction(Request $edit)
	{
		$editmemo = memorandums::where('id', $edit->route('id'))->first();
		 $query = DB::select('select id,memotype from memotypes order by memotype');
		    $query1 = DB::select('select id,name from branches order by name');
			return view('memorandums.editmemorandum')->with('list',$query)->with('branch', $query1)->with('editmemoid',$editmemo);

	}
	public function getemployeesforeditmemofunction(Request $data)
	{
		$sample = DB::table('employees')->join('positions','employees.position_id','=','positions.id')->join('departments','employees.dept_id','=','departments.id')->whereIn('branch_id',$data['array'])->select('employees.id as No','employees.id_no as ID_No','first_name','last_name','positions.name as Position','departments.name as Department')->get();
		return $sample;
	}

	 public function updatememofunction(Request $update)
    {
    	$dt = Carbon::parse($update['memodate']);
        DB::update('update memorandums set subject = ?, dates = ?, description = ?, attachments = ?, memotype_id = ? where id = ?', [$update['subjecttext'],$dt,$update['description'],$update['attachment'],$update['memotypecmb'],$update['id']]);
         DB::update('update memorecipients set status = "FAILED" where memorandum_id = ?',[$update['id']]);
		$lastid = DB::select('select id from memorandums where id = ?', [$update['id']]);
		foreach ($lastid as $key) {
			foreach ($update['recipients'] as $ids) {
			DB::insert('insert into memorecipients(memorandum_id,employee_id,status) values(?,?,?)',[$key->id,$ids,'SUCCESS']);
							}
						}
		return $update;
    }


}