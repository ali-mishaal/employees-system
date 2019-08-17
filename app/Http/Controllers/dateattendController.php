<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datattend;

class dateattendController extends Controller
{
    
    public function __construct(){

        $this::middleware('admin');
    }
    
    public function index()
    { 
        $datt = datattend::orderBy('created_at' , 'DESC')->get();
        return view('dateattend.index' , compact('datt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dateattend.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att = datattend::first();
        if (!empty($att)) {
            return redirect(route('index.daatt'))->with('msgerr' , 'you can add just once');
        }
        $this->validate($request ,[
               
               'atthour' => 'required|integer|min:0|max:10',
               'attmin' => 'required|integer|min:0|max:59',
               'demin' => 'required|integer|min:0|max:10',
               'dehour' => 'required|integer|min:0|max:59',
        ]);

        $datt = new datattend;
        $datt->atend = $request->input('atthour').":".$request->input('attmin');
        $datt->depart = $request->input('dehour').":".$request->input('demin');
        $datt->save();

        return redirect(route('index.daatt'))->with('msg' , 'date attending created succeccfully');

    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  


    public function edit($id)
    {
        
        $datt = datattend::find($id);
        return view('dateattend.edit' , compact('datt'));
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
        $datt = datattend::find($id);

        if (empty($request->input('atthour')) && empty($request->input('attmin'))  && empty($request->input('dehour')) && empty($request->input('demin')) ) 
        {
            return redirect(route('edit.daatt') , $datt->id)->with('msg' , 'you not update anything');
        }

        if ($request->input('atthour').":".$request->input('attmin') ==  $datt->atend && $request->input('dehour').":".$request->input('demin') == $datt->depart ) 
        {
            return redirect(route('edit.daatt') , $datt->id)->with('msg' , 'you not update anything');
        }

        
        $this->validate($request ,[
               
               'atthour' => 'integer|min:0|max:10',
               'attmin' => 'integer|min:0|max:59',
               'demin' => 'integer|min:0|max:10',
               'dehour' => 'integer|min:0|max:59',
        ]);

        $datt->atend = $request->input('atthour').":".$request->input('attmin');
        $datt->depart = $request->input('dehour').":".$request->input('demin');
        $datt->save();

        return redirect(route('index.daatt'))->with('msg' , 'attending time edited succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datt = datattend::find($id);
        $datt->destroy($id);
        return redirect(route('index.daatt'))->with('msg' , 'attending time deleted succeccfully');
    }
}
