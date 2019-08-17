<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\weekholy;

class weekholyController extends Controller
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
        $week = weekholy::get();
        return view('weekholy.index' , compact('week'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('weekholy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $week = weekholy::first();
        if (!empty($week)) {
            return redirect(url('weekho'))->with('msgerr' , 'you can add just once');
        }

        $this->validate($request ,[
               
               'weekday' => 'required',
        ]);

        $setting = new weekholy;
        $setting->name = implode($request->input('weekday') , ',');
        $setting->save();

        return redirect(url('weekho'))->with('msg' , 'weekends created succeccfully');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editweek($id)
    {
        $week = weekholy::find($id);
        return view('weekholy.edit' , compact('week'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateweek(Request $request, $id)
    {
        $week = weekholy::find($id);

        // if (empty($request->input('name'))) 
        // {
        //     return redirect(route('edit.set') , $week->id)->with('msg' , 'you not update anything');
        // }

        // if ($request->input('name') ==  $week->name) 
        // {
        //     return redirect(route('edit.set') , $week->id)->with('msg' , 'you not update anything');
        // }

        
        
        $week->name = implode($request->input('weekday') , ',');
        $week->save();

        return redirect(url('weekho'))->with('msg' , 'weekends created succeccfully');
        $week->save();

        return redirect(url('weekho'))->with('msg' , 'weekends edited succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyweek($id)
    {
    
        $week = weekholy::find($id);
        $week->destroy($id);
        return redirect(url('weekho'))->with('msg' , 'weekends deleted succeccfully');
    }
}
