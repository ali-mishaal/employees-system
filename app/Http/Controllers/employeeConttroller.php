<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dayholy;
use App\Attending;
use App\datattend;
use App\weekholy;
use App\Sett;
use Auth;
use Hash;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class employeeConttroller extends Controller
{

    public function __construct(){

        $this::middleware('admin');
    }
    
    public function index(Request $request)
    { 

       
        if($request->input('month'))
            $month = $request->input('month');
        else
            $month = 1;

        $user = User::orderBy('created_at' , 'DESC')->get();

        $attend = Attending::whereMonth('created_at', '=', $month)->get();

        $holiday = Dayholy::get();
        $datt = datattend::first();
        $week = weekholy::first();
       
        $weekends = explode(',', $week->name);
        $weekend=array();

        for ($i=0; $i <count($weekends) ; $i++) { 

           $name_of_day= date('l', strtotime("Friday + $weekends[$i] Days"));

           $obj = new \DatePeriod(
            Carbon::parse("first $name_of_day of this month"),
            CarbonInterval::week(),
            Carbon::parse("first $name_of_day of next month")
            );
           

              foreach ($obj as $day)
            {
                $weekend[count($weekend)] =date('Y-m-d',strtotime($day));
            }

        }


        $sett = Sett::first();

        return view('employes.index' , compact('user' , 'attend','holiday' , 'datt' ,'weekend' ,'sett'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $phone = (int)$request->input('phone');
        $phone = strlen($phone);

        if ($request->input('phone')[0] != 0 || $request->input('phone')[1] != 1 
            || $phone != 10) 
        {
             return redirect(route('create.emplo'))->with('msgphone' , 'phone not valid');
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'adress'   => 'string',
            'salary'   => 'between:0,9999.99',
            'dhiring'  => 'date',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->adress = $request->input('adress');
        $user->phone = $request->input('phone');
        $user->salary = $request->input('salary');
        $user->dhiring = $request->input('dhiring');
        $user->save();

        return redirect(route('index.emplo'))->with('msg' , 'user created succeccfully');

    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  


    public function edit($id)
    {
        
        $user = User::find($id);
        return view('employes.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $check_email = User::where('id' , '!=' , $id)->where('email' , $request->input('email'))->get();

       $phone = (int)$request->input('phone');
        
        $phone = strlen($phone);
        if ($request->input('phone')[0] != 0 || $request->input('phone')[1] != 1 
            || $phone != 10) 
        {
             return redirect(route('edit.emplo' , $id))->with('msgerr' , 'phone not valid');
        }

        if (count($check_email) > 0) 
        {
             return redirect(route('edit.emplo' , $id))->with('msgemail' , 'phone not valid');
        }
        
        
        $this->validate($request, [
            
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'adress'   => 'string',
            'salary'   => 'between:0,9999.99',
            'dhiring'  => 'date',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->adress = $request->input('adress');
        $user->phone = $request->input('phone');
        $user->salary = $request->input('salary');
        $user->dhiring = $request->input('dhiring');
        $user->save();
        return redirect(route('index.emplo'))->with('msg' , 'user Edited succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $attend = Attending::where('id_em', $id)->get();



        foreach ($attend as $value) {
            $value->destroy($value->id); 
        }

        
        $user->destroy($id);
        return redirect(route('index.emplo'))->with('msg' , 'user deleted succeccfully');
    }

    public function salary($id)
    {
        
        $attend = Attending::where('id_em' , $id )->orderby('created_at', 'DESC')->get();
        $holiday = Dayholy::get();
        $datt = datattend::first();
        $weekend = weekholy::get();
        $sett = Sett::first();

        return view('employes.salary' , compact('user','attend' , 'holiday' , 'datt' , 'weekend' ,'sett'));
    }


    public function get_month(Request $request)
    {
        $data = $request->all();
        $month = $data['month'];

        $attend = Attending::whereMonth('created_at', '=', $month)->get();

        return $attend;
    }
}
