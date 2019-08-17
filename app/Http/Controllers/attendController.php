<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attending;
use App\User;
use auth;

class attendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    
    public function index()
    {
         $attend = Attending::orderBy('created_at' , 'ASC')->get();
        return view('attend.index' , compact('attend'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $user = User::get();
       return view('attend.create' , compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $this->validate($request ,[
               'atthour' => 'required|integer|min:0|max:24',
               'attmin' => 'required|integer|min:0|max:59',
               'demin' => 'required|integer|min:0|max:24',
               'dehour' => 'required|integer|min:0|max:59',
               'user' =>'required',
        ]);

           
         date_default_timezone_set('Africa/Cairo');
       

        $attend = new Attending;
        $attend->id_em = $request->input('user');
        $attend->attend = $request->input('atthour').":".$request->input('attmin');
        $attend->depart = $request->input('dehour').":".$request->input('demin');
        $attend->save();

        
        return redirect(url('attend'))->with('msg','attending');
        
    }

    public function depart(Request $request)
    {

        date_default_timezone_set('Africa/Cairo');

        $attend = Attending::where('id_em' , Auth::user()->id)->whereDate("created_at" , "=" ,date('Y-m-d'))->first();
        

        if (empty($attend)) 
        {
            return redirect(url('/'))->with('msgerr','you not attending');
        }else
        {
            if ($attend->depart !== '00:00:00') {
                return redirect(url('/'))->with('msgerr','you already depart');
            }
            $attend->id_em = Auth::user()->id;
            $attend->depart = date("h:ia");
            $attend->save();
            return redirect(url('/'))->with('msg','you depart');
        }
        


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editatt($id)
    {
        $attend = Attending::find($id);
        return view('attend.edit' , compact('attend'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateatt(Request $request, $id)
    {
        $attend = Attending::find($id);

        if (empty($request->input('attend')) && empty($request->input('depart')) ) 
        {
            return redirect(route('edit.attend') , $attend->id)->with('msg' , 'you not update anything');
        }

        if ($request->input('attend') ==  $attend->attend && $request->input('depart') == $attend->depart ) 
        {
            return redirect(route('edit.attend') , $attend->id)->with('msg' , 'you not update anything');
        }

        
        $this->validate($request ,[
               
               'attend' => 'required|min:0',
               'add_hour' => 'required|min:0',
        ]);

        
        $setting->add_hour = $request->input('attend');
        $setting->late_day = $request->input('depart');
        $setting->save();

        return redirect(url('attend'))->with('msg' , 'attending edited succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyatt($id)
    {
        $attend = Attending::find($id);
        $attend->destroy($id);
        return redirect(url('attend'))->with('msg' , 'attend deleted succeccfully');
    }


    public function edit($id)
    { 
        $attend = Attending::find($id);
        return view('attend.edit' , compact('attend'));
    }


    public function update(Request $request , $id)
    { 
        $attend = Attending::find($id);
        $this->validate($request ,[
               'atthour' => 'integer|min:0|max:24',
               'attmin' => 'integer|min:0|max:59',
               'demin' => 'integer|min:0|max:24',
               'dehour' => 'integer|min:0|max:59',
        ]);

           
         date_default_timezone_set('Africa/Cairo');
       
        $attend->attend = $request->input('atthour').":".$request->input('attmin');
        $attend->depart = $request->input('dehour').":".$request->input('demin');
        $attend->save();

        
        return redirect(url('attend'))->with('msg','attending');
    }
}
