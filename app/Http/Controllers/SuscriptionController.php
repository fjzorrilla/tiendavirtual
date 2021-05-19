<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Suscription;
use Illuminate\Support\Str;
use App\Models\ProductSuscription;

class SuscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suscription=Suscription::getAllSuscription();
        // return $category;
        return view('backend.suscription.index')->with('suscription',$suscription);
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats=Category::orderBy('title','ASC')->get();
        $products=Product::getAllProduct();
        return view('backend.suscription.create')->with('parent_cats',$parent_cats)->with('products',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $this->validate($request,[
            'title'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data= $request->all();
        $slug=Str::slug($request->title);
        $count=Suscription::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        // return $data;   
        $status=Suscription::create($data);
        if($status){
            request()->session()->flash('success','Suscription successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('suscription.index');


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
        $suscription=Suscription::findOrFail($id);
        return view('backend.suscription.edit')->with('suscription',$suscription);
    }

    public function details($slug){
        $suscription=Suscription::where('slug',$slug)->first();
        $prodSuscript = ProductSuscription::where('suscription_id',$suscription->id)->get();
        $productos = [];
        foreach ($prodSuscript as $key => $producto) {
            $list = Product::where('id',$producto->product_id)->get();
            $productos[$key] = $list[0];
        }
        return view('frontend.pages.suscription')->with('products',$productos)->with('suscription',$suscription);
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
        // return $request->all();
        $Suscription=Suscription::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data= $request->all();
        // return $data;
        $status=$Suscription->fill($data)->save();
        if($status){
            request()->session()->flash('success','Suscripcion successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('suscription.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suscrption=Suscription::findOrFail($id);
        
        $status=$suscrption->delete();
        
        if($status){
            request()->session()->flash('success','suscrption successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting category');
        }
        return redirect()->route('suscription.index');
    }

    public function getChildByParent(Request $request){
        // return $request->all();
        $category=Category::findOrFail($request->id);
        $child_cat=Category::getChildByParentIDSLECT($request->id); 
        // return $child_cat;
        if(count($child_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }
}
