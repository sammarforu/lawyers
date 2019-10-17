<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests;
use Session;
class RoleController extends Controller
{
	public function __construct()
	{
	return $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $users = User::orderBy('id', 'asc')->get();
     //return $users;
	 return view('roles.index', Compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
		$user->roles()->detach();
		
		if($request['role_student']){
		$user->roles()->attach(Role::where('name', 'Student')->first());
		}
		if($request['role_teacher']){
		$user->roles()->attach(Role::where('name', 'Teacher')->first());
		}
		if($request['role_admin']){
		$user->roles()->attach(Role::where('name', 'Admin')->first());
		}
		return redirect()->back();
    }

    public function addUser(Request $request){
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required'
        ]);
        $users = new User();
        
        //dd($request->all());
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->password = bcrypt($request->get('password'));
        $users->save();
        $users->roles()->attach(Role::where('name', 'Student')->first());
        Session::flash('flash_message', 'User Added Successfully!');
        return redirect('roles/create');
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
        //
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
    //
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
