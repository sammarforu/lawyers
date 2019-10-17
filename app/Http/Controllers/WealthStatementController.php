<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Catagory;
use App\WealthStatement;
use App\WealthStatementDetail;
use Session;
class WealthStatementController extends Controller
{
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
    return view('wealth-statement.create', Compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //return $request->all();
    $this->validate($request, [
            'voucher_no' => 'required',
            'client_name' => 'required',
            'cnic' => 'required',
            'income' => 'required',
            'expense' => 'required'
        ]);

        $routine = WealthStatement::create([
            'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'client_name' => $request->get('client_name'),
            'catagory_id' => $request->get('catagory_id'),
            'cnic' => $request->get('cnic'),
            'income' => $request->get('income'),
            'expense' => $request->get('expense'),
            'cash' => $request->get('cash'),
            'bank_balance' => $request->get('bank_balance'),
            'gold' => $request->get('gold'),
            'prize_bond' => $request->get('prize_bond'),
            'bike' => $request->get('bike'),
        ]);
      
        if(!is_null($request->file('attachment')))
            {
            $imageName = Input::file('attachment')->getClientOriginalName();
            //return $imageName;
            $request->file('attachment')->move( base_path() .'/public/upload/statement/', $imageName);
            $routine->attachment = Input::file('attachment')->getClientOriginalName();
        $routine->save();
            // return $imageName; 
            }

            $count = Count($request->detail);
            //return $count;
    for($i=0; $i<$count; $i++){
      if($request->detail[$i] != null){
      $keywords = new WealthStatementDetail();
      $keywords->statement_id = $routine['id'];
      $keywords->detail = $request->detail[$i];
      $keywords->save();
    }
  }

        Session::flash('flash_message', 'Wealth Statement Added Successfully!');
        return redirect('wealth-statement/create');
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
    $ntns = WealthStatement::where('catagory_id', '=', $id)->get();
    return view('wealth-statement.index', Compact('ntns', 'office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $edit = WealthStatement::findOrFail($id);
    $details = WealthStatementDetail::where('statement_id', '=', $id)->get();
    //return $details;
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return  view('wealth-statement.edit', Compact('edit', 'offices', 'details'));
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
    $this->validate($request, [
            'voucher_no' => 'required',
            'client_name' => 'required',
            'cnic' => 'required',
            'income' => 'required',
            'expense' => 'required'
        ]);
    $update = WealthStatement::findOrFail($id);
        if(!is_null($request->file('attachment')))
        {   
            $imageName = Input::file('attachment')->getClientOriginalName();
            //return $imageName;
            $request->file('attachment')->move(
                base_path() . '/public/upload/statement/', $imageName);
            $update->update(array(
            'attachment' => $imageName
            ));
        }
          $update->update(array(
          'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'client_name' => $request->get('client_name'),
            'catagory_id' => $request->get('catagory_id'),
            'cnic' => $request->get('cnic'),
            'income' => $request->get('income'),
            'expense' => $request->get('expense'),
            'cash' => $request->get('cash'),
            'bank_balance' => $request->get('bank_balance'),
            'gold' => $request->get('gold'),
            'prize_bond' => $request->get('prize_bond'),
            'bike' => $request->get('bike')
        ));
        $update->save();
        
         WealthStatementDetail::where('statement_id', '=', $id)->delete();
        $count = Count($request->detail);
            //return $count;
        for($i=0; $i<$count; $i++){
          if($request->detail[$i] != null){
          $keywords = new WealthStatementDetail();
          $keywords->statement_id = $update['id'];
          $keywords->detail = $request->detail[$i];
          $keywords->save();
        }
        }
        Session::flash('flash_message', 'Record successfully Updated!');
        return redirect('/wealth-statement/' . $request->catagory_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $student = WealthStatement::findOrFail($id);
        $student->delete();
        WealthStatementDetail::where('statement_id', '=', $id)->delete(); 
        //return redirect()->back();
        return "Record Successfully Deleted!";
    }

    public function details($id){
    $data = WealthStatement::with('biller')->with('office')->with('statement_detail')
    ->where('id', '=', $id)->get();
    return view('wealth-statement.details', Compact('data'));
    //return $data;
    }
}
