<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class profileController extends Controller
{
    public function index()
    {
    	return view('profile.index');
    }


    public function edit()
    {
    	return view('profile.edit');
       
    }

    public function update(Request $request)
    {

    	$user = User::find(Auth::user()->id);

    	$check_email = User::where('id' , '!=' , Auth::user()->id)->where('email' , $request->input('email'))->get();
    	

    	$phone = (int)$request->input('phone');
        $phone = strlen($phone);

        if ($request->input('phone')[0] != 0 || $request->input('phone')[1] != 1 
            || $phone != 10) 
        {
             return redirect(route('edit.profile' , $id))->with('msgphone' , 'phone not valid');
        }

        if (count($check_email) > 0) 
        {
             return redirect(route('edit.profile' , $id))->with('msgemail' , 'phone not valid');
        }

    	$this->validate($request, [
            'name' => 'string|max:255',
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

        return redirect(route('index.profile'))->with('msg' , 'user Edited succeccfully');
       
    }


    public function editpass()
    {
        return view('profile.pass');
    }

    public function updatepass(Request $request)
    {
        $this->validate($request, [

            'cr-pass' => 'required|string|min:6',
            'nw-pass' => 'required|string|min:6',
        ]);


       $user = User::find(Auth::user()->id);

       $user_pass = $user->password;
       $input_pass = $request->input('cr-pass');

       if(Hash::check($input_pass , $user_pass))
       {
       	 $user->password = Hash::make($request->input('nw-pass'));
       	 $user->save();

       	 return redirect(route('index.profile'))->with('msg' , 'password updated success');
       }else
       {
       	 return redirect(route('pass.profile'))->with('msgerr' , 'password updated failed');
       }


    }
}
