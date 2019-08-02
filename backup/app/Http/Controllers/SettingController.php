<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\SystemLogo;
use Session;
use Illuminate\Support\Facades\Input;
class SettingController extends Controller
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
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        	if(Input::get('logo')){
			$imageName = Input::file('image')->getClientOriginalName();
			$request->file('image')->move( base_path() .'/public/upload/logo/', $imageName);
			//return $imageName;
			$alter = SystemLogo::findOrFail($id);
			$alter->create(array(
			'image' => $imageName
			)); 
			//}
		Session::flash('flash_message', 'Image Added Successfully!');
		return redirect ('dashboard');
		}
		
		elseif(Input::get('settings')){
        $this->validate ($request, [
		'system_name' => 'required',
		'title' => 'required',
		'address' => 'required',
		'phone' => 'required',
		'currency' => 'required',
		'city' => 'required',
		'state' => 'required',
		'country' => 'required'
		]);
		//$update = Setting::findOrFail($id);
		$update->create($request->all());
		Session::flash('flash_message', 'Settings Added Successfully!');
		return redirect('dashboard');
    }
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
	//return view('settings.edit');
        $edit = Setting::findOrFail($id);
		return view('settings.edit', Compact('edit'));
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
		//$this->validate ($request, ['image' => 'required']);
		if(Input::get('logo')){
			if(!is_null($request->file('image')))
			{
			$imageName = Input::file('image')->getClientOriginalName();
			$request->file('image')->move( base_path() .'/public/upload/logo/', $imageName);
			//return $imageName;
			$alter = SystemLogo::findOrFail($id);
			$alter->update(array(
			'image' => $imageName 
			)); 
			}
		Session::flash('flash_message', 'Image Updated Successfully!');
		return redirect ('dashboard');
		}
		
		elseif(Input::get('settings')){
        $this->validate ($request, [
		'system_name' => 'required',
		'title' => 'required',
		'address' => 'required',
		'phone' => 'required',
		'currency' => 'required',
		'city' => 'required',
		'state' => 'required',
		'country' => 'required'
		]);
		$update = Setting::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Settings Updated Successfully!');
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
