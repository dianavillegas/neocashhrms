<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contributionrates;
use App\contributions;

class ContributionsController extends Controller
{
    public function contributions(){
    	$contributions = contributions::all();
    	return view('contributions.contributions')->with('contributions', $contributions);
    }

    public function editcontribution(Request $data){
    	$contribution = contributions::where('id', $data->route('id'))->first();
    	$cr = contributionrates::where('contribution_id', $data->route('id'))->get();
    	return view('contributions.editcontribution')->with('contribution', $contribution)->with('conr', $cr);
    }
}
