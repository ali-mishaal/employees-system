<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dayholy;

class dayholyController extends Controller
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
        $day = Dayholy::orderBy('created_at' , 'DESC')->get();
        return view('dayholy.index' , compact('day'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dayholy.create');
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
               
               'name' => 'required|string',
               'date' => 'required|date',
        ]);

        $day = new Dayholy;
        $day->name = $request->input('name');
        $day->date = $request->input('date');
        $day->save();

        return redirect(url('dayho'))->with('msg' , 'dayholidays created succeccfully');
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editday($id)
    {
       $day = Dayholy::find($id);
        return view('dayholy.edit' , compact('day'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateday(Request $request, $id)
    {
        $day = Dayholy::find($id);

        if (empty($request->input('name')) && empty($request->input('date')) ) 
        {
            return redirect(route('edit.day') , $day->id)->with('msg' , 'you not update anything');
        }

        if ($request->input('name') ==  $day->name && $request->input('date') == $day->date ) 
        {
            return redirect(route('edit.day') , $day->id)->with('msg' , 'you not update anything');
        }

        
        $this->validate($request ,[
               
               'name' => 'required|string',
               'date' => 'required|date',
        ]);

        
        $day->name = $request->input('name');
        $day->date = $request->input('date');
        $day->save();

        return redirect(url('dayho'))->with('msg' , 'day holidays edited succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyday($id)
    {
        $day = Dayholy::find($id);
        $day->destroy($id);
        return redirect(url('dayho'))->with('msg' , 'day holidays deleted succeccfully');
    }
}
