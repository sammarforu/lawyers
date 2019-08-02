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
		$this->validate($request, [
		'name' => 'required',
		'email' => 'required',
		'image' => 'required'
		]);
        //check which submit was clicked on
        if(Input::get('profile')) {

			$product = User::findOrFail($id);
			$product->update(array(
			  'name' => $request->get('name'),
			  'email' => $request->get('email'),
			  'image' => $imageName
			));
			
			if(!is_null($request->file('image')))
			{
			$imageName = Input::file('image')->getClientOriginalName();
			$request->file('image')->move(
				base_path() . '/public/upload/users/', $imageName);
			}	
			Session::flash('flash_message', 'Record successfully added!');
			return redirect('dashboard'); 
        } 
		elseif(Input::get('PasswordSubmit')) 
		{
			$currentPassword = Input::get("current_password");
			$currentUser = User::findOrFail($id);
			
			if(Hash::check($currentPassword, $currentUser->password))
			{
				$newPassword = Input::get('password');
				$currentUser->password = bcrypt($newPassword);
				$currentUser->save();
			}
			return redirect('dashboard');			
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
