<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sett;

class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this::middleware('admin');
    }
    
    public function index()
    { 
        $settings = Sett::orderBy('created_at' , 'DESC')->get();
        return view('setting.index' , compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $set = Sett::first();
        if (!empty($set)) {
            return redirect(url('setting'))->with('msgerr' , 'you can add just once');
        }
        $this->validate($request ,[
               
               'late_hour' => 'required|min:0|between:0,99.99',
               'add_hour' => 'required|min:0|between:0,99.99',
               'late_day' => 'required|min:0|between:0,99.99',
               'add_day' => 'required|min:0|between:0,99.99',
        ]);

        $setting = new Sett;
        $setting->late_hour = $request->input('late_hour');
        $setting->add_hour = $request->input('add_hour');
        $setting->late_day = $request->input('late_day');
        $setting->add_day = $request->input('add_day');
        $setting->save();

        return redirect(url('setting'))->with('msg' , 'setting created succeccfully');

    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  


    public function editset($id)
    {
        
        $setting = Sett::find($id);
        return view('setting.edit' , compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateset(Request $request, $id)
    {
        $setting = Sett::find($id);

        if (empty($request->input('late_hour')) && empty($request->input('add_hour')) && empty($request->input('late_day')) && empty($request->input('add_day'))) 
        {
            return redirect(route('edit.set') , $setting->id)->with('msg' , 'you not update anything');
        }

        if ($request->input('late_hour') ==  $setting->late_hour && $request->input('add_hour') == $setting->add_hour && $request->input('late_day') == $setting->late_day  && 
            $request->input('add_day') == $setting->add_day) 
        {
            return redirect(route('edit.set') , $setting->id)->with('msg' , 'you not update anything');
        }

        
        $this->validate($request ,[
               
               'late_hour' => 'required|min:0|between:0,99.99',
               'add_hour' => 'required|min:0|between:0,99.99',
               'late_day' => 'required|min:0|between:0,99.99',
               'add_day' => 'required|min:0|between:0,99.99',
        ]);

        
        $setting->late_hour = $request->input('late_hour');
        $setting->add_hour = $request->input('add_hour');
        $setting->late_day = $request->input('late_day');
        $setting->add_day = $request->input('add_day');
        $setting->save();

        return redirect(url('setting'))->with('msg' , 'setting edited succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyset($id)
    {
        $setting = Sett::find($id);
        $setting->destroy($id);
        return redirect(url('setting'))->with('msg' , 'setting deleted succeccfully');
    }
}
