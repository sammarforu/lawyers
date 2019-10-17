<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;
use DB;
use Auth;
use Hash;
class AccountSettingController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function edit($id)
	{
		$edit = User::findOrFail($id);
		$user = DB::table('users')->where('id', Auth::user()->id)->get();
		//return $user;
		return view('account.edit', Compact('edit', 'user', 'id'));
		
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
		
        //check which submit was clicked on
        if(Input::get('profile')) {
            $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email'
        ]);
             $user = User::findOrFail($id);
             //return $user;
			if(!is_null($request->file('image')))
            {
                $imageName = Input::file('image')->getClientOriginalName();
                $request->file('image')->move( 
                    public_path() .'/upload/users/', $imageName);
                 $user->update(array(
                  'image' => $imageName
                )); 
            }
            $user->update(array(
              'name' => $request->get('name'),
              'email' => $request->get('email')
            )); 
            $user->save();

			Session::flash('flash_message', 'Account successfully Updated!');
            return redirect('dashboard');
			//return redirect('account/'.$user->id.'/edit'); 
        } 
		elseif(Input::get('PasswordSubmit')) 
		{
            $this->validate($request, [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password|min:6|different:old_password'
            ]);

			$currentPassword = Input::get("old_password");
            $NewPassword = Input::get("new_password");
			$currentUser = User::findOrFail($id);

            if (Hash::check($currentPassword, $currentUser->password)) { 
               $currentUser->fill([
                'password' => Hash::make($NewPassword)
                ])->save();

              Session::flash('flash_message', 'Password Changed successfully!');
                return redirect('dashboard');

            } else {
                Session::flash('flash_message', 'Current Password is Incorrect!');
                return redirect('account/'.$currentUser->id.'/edit');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
