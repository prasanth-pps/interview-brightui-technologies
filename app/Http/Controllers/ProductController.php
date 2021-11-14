<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFile;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategory = ProductCategory::get();
        $productModel = ProductModel::get();
        return view('product',compact('productCategory','productModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $product = Product::with('productcategory','productmodel','productfile')->paginate();
        return view('product-list',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'product_model' => 'required',
            'product_category' => 'required',
            'selling_price' => 'required',
            'cost_price' => 'required',
            'gst' => 'required',
            'cgst' => 'required',
            'sgst' => 'required',
            'product_description' => 'required',
        ]);
        if($validator->fails()) {
            $error_messages = implode(',',$validator->messages()->all());
            return back()->withInput()->withErrors($error_messages);
        }else {
            try {
                $data = Product::create($request->all());
                if ($request->hasFile('file')) {
                    foreach ($request->file('file') as $key => $value) {
                        $image = $value;
                        $name = date("Y-m-d") . "-" . time() . '.' . $image->getClientOriginalExtension();
                        $folder_path = '/uploads';
                        $destinationPath = public_path($folder_path);
                        $image->move($destinationPath, $name);
                        $ProductFile = new ProductFile;
                        $ProductFile->product_id = $data->id;
                        $ProductFile->name = $name;
                        $ProductFile->save();
                    }
                }
            } catch (\Throwable $th) {
                
                return back()->with('error', $th);
            }
        }
        return redirect()->route('product')->with('success', 'Details Added Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productListPagination(Request $request)
    {

        $productDetails = Product::with('productcategory','productmodel','productfile')->where('status',1);
		$product_model = $request->product_model;
		$product_category = $request->product_category;
        if($request->sSearch!='')
        {
            $keyword = $request->sSearch;
            $productDetails = $productDetails->when($keyword!='',
            function($q) use($keyword){
                return $q->Where('products.product_name','like','%'.$keyword.'%');
            });
        }
        if($product_category > 0){
			$productDetails = $productDetails->where(function ($q)use($product_category) {
				$q->Where('products.product_category', 'like', '%'.$product_category.'%');
			});
        }
        if($product_model > 0){
			$productDetails = $productDetails->where(function ($q)use($product_model) {
				$q->Where('products.product_model', 'like', '%'.$product_model.'%');
			});
        }
		$product = $productDetails->get();
        $offset = 0;
        $column=array();
        foreach($product as $value)
        {
            $col['id']=$offset+1;
            $col['product_name']=isset($value->product_name)?$value->product_name:"";
            $col['product_category']=isset($value->productcategory->name)?$value->productcategory->name:"";
            $col['product_model']=isset($value->productmodel->name)?$value->productmodel->name:"";
            array_push($column, $col);
            $offset++;
        }
        $product['sEcho']=$request->sEcho;
        $product['aaData']=$column;
        $product['iTotalRecords']=count($product);
        $product['iTotalDisplayRecords']=count($product);
        return json_encode($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {

        $productCategory = ProductCategory::get();
        $productModel = ProductModel::get();
        return view('product-report',compact('productCategory','productModel'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Product = Product::find($request->product_id);
        if ($Product->delete()) {
            echo "0";
        } else {
            echo "1";
        }
    }

}
