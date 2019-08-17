<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dayholy;
use App\Attending;
use App\datattend;
use App\weekholy;
use App\Sett;
use Auth;

class salaryController extends Controller
{
	public function __construct(){

        $this::middleware('auth');
    }
    
    
     public function index()
     {
        
        $attend = Attending::where('id_em' , Auth::user()->id )->orderby('created_at', 'DESC')->get();
        $holiday = Dayholy::get();
        $datt = datattend::first();
        $weekend = weekholy::get();
        $sett = Sett::first();

       

        
     	return view('salary' , compact('attend' , 'holiday' , 'datt' , 'weekend' ,'sett'));
     }
}
