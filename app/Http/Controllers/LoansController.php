<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loan_types;
use App\employees;
use App\loans;
use Illuminate\Support\Facades\DB;

class LoansController extends Controller
{
	public function createloantype(){
		return view('loantypes.addloantype');
	}
    public function submitloantype(Request $data){
       $loantype = new loan_types();
       $loantype->name = $data['name'];
       $loantype->save();

       return redirect(route('loantypes'))->with('success', 'Department '.$loantype->name.' Saved Successfully');  
    }

    public function loantypes(){
      $loantypes = loan_types::all();
      return view('loantypes.loantypes')->with('loantypes', $loantypes);
    }

    public function editloantype($id){
      $loantype = loan_types::where('id',$id)->first();
      return view('loantypes.editloantype')->with('loantype', $loantype);
    }

    public function updateloantype(Request $data){
      //return $data->all();
       $loantype = loan_types::find($data['id']);
       $loantype->name = $data['name'];
       $loantype->save();
       return redirect(route('loantypes'))->with('success', 'Loan Type '.$loantype->name.' Updated Successfully');
    }

    public function createloan(){
    	$employees = employees::all();
    	$loantypes = loan_types::all();
    	return view('loans.addloan')->with('employees', $employees)->with('loantypes', $loantypes);
    }

    public function submitloan(Request $data){
      $loan = new loans();
      $loan->employee_id = $data['employeeid'];
      $loan->loantype_id = $data['loantypeid'];
      $loan->amount = $data['amount'];
      $loan->reason = $data['reason'];
      $loan->terms_payable = $data['terms'];
      $loan->save();
      return redirect(route('loans'))->with('success', 'Loan Application #'.$loan->id.' Saved Successfully');
    }

    public function loans(){
      $loans = DB::table('loans')->join('employees', 'employee_id', '=','employees.id')->join('loan_types','loantype_id', '=','loan_types.id')->select('employees.first_name', 'employees.first_name', 'employees.last_name', 'loan_types.name', 'loans.*')->get();
      return view('loans.loans')->with('loans', $loans);
    }

    public function editloan(Request $data){
      $loan = loans::where('id',$data->route('id'))->get();
      return view('loans.editloan');
    }

    public function updateloan(Request $data){
      $loan = loans::find($data['id']);
      $loan->employee_id = $data['employeeid'];
      $loan->loantype_id = $data['loantypeid'];
      $loan->amount = $data['amount'];
      $loan->reason = $data['reason'];
      $loan->terms_payable = $data['terms'];
      $loan->save();
      return redirect(route('loans'))->with('success', 'Loan Application #'.$loan->id.' Updated Successfully');
    }




}
