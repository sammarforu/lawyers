<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Catagory;
use App\DailyRoutine;
use Session;
class DailyRoutineController extends Controller
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
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return view('daily-tasks.create', Compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'voucher_no' => 'required',
            'client_name' => 'required',
            'business_name' => 'required',
            'cell_no' => 'required',
            'cnic' => 'required',
            'metter' => 'required',
            'status' => 'required'
        ]);

        $routine = DailyRoutine::create([
            'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'task_date' => $request->get('task_date'),
            'catagori_id' => $request->get('catagori_id'),
            'client_name' => $request->get('client_name'),
            'business_name' => $request->get('business_name'),
            'cell_no' => $request->get('cell_no'),
            'cnic' => $request->get('cnic'),
            'metter' => $request->get('metter'),
            'status' => $request->get('status'),
            'task' => $request->get('task'),
        ]);
      
        if(!is_null($request->file('attachment')))
            {
            $imageName = Input::file('attachment')->getClientOriginalName();
            //return $imageName;
            $request->file('attachment')->move( base_path() .'/public/upload/files/', $imageName);
            $routine->attachment = Input::file('attachment')->getClientOriginalName();
        $routine->save();
            // return $imageName; 
            }



        Session::flash('flash_message', 'Task Added Successfully!');
        return redirect('daily-tasks/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $office = Catagory::where('id', '=', $id)->get();
    $tasks = DailyRoutine::where('catagori_id', '=', $id)->get();
    return view('daily-tasks.index', Compact('tasks', 'office'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $edit = DailyRoutine::findOrFail($id);
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return  view('daily-tasks.edit', Compact('edit', 'offices'));
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
    //return $request->all();
        $update = DailyRoutine::findOrFail($id);
        if(!is_null($request->file('attachment')))
        {   
            $imageName = Input::file('attachment')->getClientOriginalName();
            //return $imageName;
            $request->file('attachment')->move(
                base_path() . '/public/upload/files/', $imageName);
            $update->update(array(
            'attachment' => $imageName
            ));
        }
          $update->update(array(
          'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'task_date' => $request->get('task_date'),
            'catagori_id' => $request->get('catagori_id'),
            'client_name' => $request->get('client_name'),
            'business_name' => $request->get('business_name'),
            'cell_no' => $request->get('cell_no'),
            'cnic' => $request->get('cnic'),
            'metter' => $request->get('metter'),
            'status' => $request->get('status'),
            'task' => $request->get('task')
        ));
        $update->save();
        
        Session::flash('flash_message', 'Record successfully Updated!');
        return redirect('/daily-tasks/' . $request->catagori_id);
        //return redirect('/students/' . $update->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $student = DailyRoutine::findOrFail($id);
        $student->delete(); 
        //return redirect()->back();
        return "Record Successfully Deleted!";
    }

    public function details($id){
    $data = DailyRoutine::with('biller')->with('office')
    ->where('id', '=', $id)->get();
    return view('daily-tasks.details', Compact('data'));
    return $data;
    }
}
