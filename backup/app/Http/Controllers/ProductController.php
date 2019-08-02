<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductDetail;
use App\SaleDetial;
use App\Catagory;
use App\Publisher;
use App\Setting;
use Session;
use PDF;
use Excel;
class ProductController extends Controller
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
		$products = Product::with(['publisher_detail'])->with(['products_detail'])->with('sale_detail')->OrderBy('product_name', 'asc')->get();
        
		//return $products; 
		return view('products.index', Compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$code = Product::OrderBy('id', 'asc')->get();
		
		//return $code;
        $catagories = Catagory::OrderBy('catagory_name', 'asc')->pluck('catagory_name', 'id');
		$publishers = Publisher::OrderBy('name', 'asc')->pluck('name', 'id');
		return view('products.create', Compact ('catagories', 'publishers', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate ($request, [
		'product_code' => 'required',
		'product_english' => 'required',
		'product_cost' => 'required',
		'product_price' => 'required'
		]);
        Product::create($request->all());
		Session::flash('flash_message', 'Product Added Successfully!');
		return redirect('products/create');
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
		$edit = Product::findOrFail($id);
		$catagories = Catagory::OrderBy('catagory_name', 'asc')->pluck('catagory_name', 'id');
		$publishers = Publisher::OrderBy('name', 'asc')->pluck('name', 'id');
		return view('products.edit', Compact('edit', 'catagories', 'publishers'));
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
		$this->validate ($request, [
		'product_code' => 'required',
		'product_name' => 'required',
		'product_cost' => 'required',
		'product_price' => 'required'
		]);
        $update = Product::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Product Updated Successfully!');
		return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Product::findOrFail($id);
		$delete->delete();
		return "Prduct Deleted Successfully!";
    }
	
   
    
	public function print_books()
	{
	$products = Product::with(['publisher_detail'])->with(['products_detail'])->with('sale_detail')->OrderBy('product_name', 'asc')->get();
		//return $products; 
		$company_detail = Setting::where('id', '=', 1)->get();
		return view('products.print', Compact('products', 'company_detail'));
	}
	
	public function getPDF()
	{
	$products = Product::with(['publisher_detail'])->with(['products_detail'])->with('sale_detail')->OrderBy('product_name', 'asc')->get();
	$pdf = PDF::loadView('products.productspdf', ['products' => $products]);
	return $pdf->download('products.pdf');
	}
	
	public function getExcel()
	{
	//$data = Product::with(['publisher_detail'])->with(['products_detail'])->with('sale_detail')->OrderBy('product_name', 'asc')->get(['products.product_code AS Code', 'Product_english AS Book', 'publishers.name AS Publisher', 'products.year', 'products.product_price'])->toArray();
	$data = Product::join('publishers', 'publishers.id', '=', 'products.publisher_id')->get(['products.product_code AS Code', 'Product_english AS Product', 'author AS Author', 'publishers.name AS Publisher', 'products.product_cost As Product_Cost', 'products.product_price AS Product_Price', 'products.year'])->toArray();
		return Excel::create('products.importExport', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download();
	}
}
