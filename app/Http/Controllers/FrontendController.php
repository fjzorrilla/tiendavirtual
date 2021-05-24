<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Politicas;
use App\Models\Terminos;
use App\Models\Delivery;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Suscription;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;
Use Redirect;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str; 
use Illuminate\Http\Request; 
use Mail;
use App\Mail\EmergencyCallReceived;
use App\DayShipping;
class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $featured=Product::where('status','active')->where('is_featured',1)->where('brand_id','<>2')->orderBy('price','DESC')->limit(2)->get();
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(4)->get();
        $banners=Banner::where('status','active')->orderBy('id','DESC')->get();
        // return $banner;
        $products=Product::where('status','active')->where('brand_id','<>2')->orderBy('id','DESC')->limit(8)->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        $moresale = Cart::where('order_id','<>',null)->pluck('product_id')->groupby('product_id');
        $suscriptions=Suscription::where('status','active')->orderBy('id','DESC')->get();   
        $ofertas=Product::where('status','active')->where('discount','>','0')->orderBy('id','DESC')->limit(4)->get(); 
        $humanoMascota=Product::where('status','active')->where('cat_id','15')->orderBy('id','DESC')->limit(4)->get();
        // return $category;
        return view('frontend.index')
                ->with('featured',$featured)
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('moresale',$moresale) 
                ->with('suscriptions',$suscriptions) 
                ->with('category_lists',$category)
                ->with('ofertas',$ofertas)
                ->with('humanoMascota',$humanoMascota);
    }   

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }
    public function politicas(){
        $politicas=Politicas::first();
        return view('frontend.pages.politicas')->with('politicas',$politicas); 
    }
    public function terminos(){
        $terminos=Terminos::first();
        return view('frontend.pages.terminos')->with('terminos',$terminos); 
    }
    public function delivery(){
        $delivery=Delivery::first();
        return view('frontend.pages.delivery')->with('delivery',$delivery); 
    }
    public function contact(){
        return view('frontend.pages.contact');
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug); 
        // dd($product_detail);
        return view('frontend.pages.product_detail')->with('product_detail',$product_detail);
    }

    public function productGrids(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productOferts(){
      
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=Product::where('status','active')->where('discount','>', 0)->paginate($_GET['show']);
        }
        else{
            $products=Product::where('status','active')->where('discount','>', 0)->paginate(9);
        }

        // Sort by name , price, category
        return view('frontend.pages.product-ofertas')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productDestacados(){
      
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(6)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=Product::where('status','active')->where('is_featured', 1)->paginate($_GET['show']);
        }
        else{
            $products=Product::where('status','active')->where('is_featured', 1)->paginate(9);
        }

        // Sort by name , price, category
        return view('frontend.pages.destacados')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productLists(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(6)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category

        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }

            $sortByURL='';
            if(!empty($data['sortBy'])){
                $sortByURL .='&sortBy='.$data['sortBy'];
            }

            $catURL="";
            if(!empty($data['category'])){
                foreach($data['category'] as $category){
                    if(empty($catURL)){
                        $catURL .='&category='.$category;
                    }
                    else{
                        $catURL .=','.$category;
                    }
                }
            }


            $priceRangeURL="";
            if(!empty($data['price_range'])){
                $priceRangeURL .='&price='.$data['price_range'];
            }
            if(request()->is('e-shop.loc/product-grids')){
                return redirect()->route('product-grids',$catURL.$priceRangeURL.$showURL.$sortByURL);
            }
            else{
                return redirect()->route('product-lists',$catURL.$priceRangeURL.$showURL.$sortByURL);
            }
    }
    public function productSearch(Request $request){
        $recent_products=Product::where('status','active')->where('brand_id','1')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function calendarAjaxDate(Request $request){
        $dates = DB::table('day_shippings')->get();
        return response()->json(['status'=>true,'msg'=>'','data'=>$dates]);
    }
    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request){

        $categoryId = DB::table('categories')->where('slug', '=', $request->slug)->first();
        $products=Product::where('status','active')->where('cat_id', $categoryId->id)->paginate(9);
        $recent_products=Product::where('status','active')->where('brand_id','1')->orderBy('id','DESC')->get();
        if(request()->is('e-shop.loc/product-grids')){

            return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
        }

    }
    public function productSubCat(Request $request){

        $categoryId = DB::table('categories')->where('slug', '=', $request->sub_slug)->first();
        
        $products=Product::where('status','active')->where('child_cat_id', $categoryId->id)->paginate(9);

        $recent_products=Product::where('status','active')->where('brand_id','1')->orderBy('id','DESC')->get();
        if(request()->is('e-shop.loc/product-grids')){

            return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
        }

    }
    public function productSubSubCat(Request $request){
        $categoryId = DB::table('categories')->where('slug', '=', $request->sub_slug)->first();
        
        $products=Product::where('status','active')->where('cat_id', $categoryId->id)->paginate(9);

        $recent_products=Product::where('status','active')->where('brand_id','1')->orderBy('id','DESC')->get();
        if(request()->is('e-shop.loc/product-grids')){

            return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
        }

    }
    public function blog(){
        $post=Post::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $cat_ids;
            $post->whereIn('post_cat_id',$cat_ids);
            // return $post;
        }
        if(!empty($_GET['tag'])){
            $slug=explode(',',$_GET['tag']);
            // dd($slug);
            $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id',$tag_ids);
            // return $post;
        }

        if(!empty($_GET['show'])){
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
        }
        else{
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }

    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            Session::put('user',$data['email']);
            request()->session()->flash('success','Successfully login');
            Session::flash('success','Inicio de Sesión Exitoso!');
            return redirect()->route('home');
        }
        else{
            Session::flash('error','Usuario o password incorrectos!');
            request()->session()->flash('error','Usuario o password incorrectos!');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return back();
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }
    public function passwordResetForm(Request $request){
        
        $user = DB::table('users')->where('email', '=', $request->email)->first();
        
        if (!$user) {
            request()->session()->flash('error','Usuario no Existe en Nuestra Base de Datos!');
            return back();
        }
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 60; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => implode($pass),
            'created_at' => $date
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            request()->session()->flash('success','Se ha enviado un email para su verificacion!');
            return back();
            
        } else {
            request()->session()->flash('error','Error al enviar la verificación!');
            return back();
        }
    }
    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        
        $link = config('base_url') . 'password/reset/' . $token . '/' . $user->email;

        try {
            Mail::to($user->email)->send(new EmergencyCallReceived($link)); 
            return true;
        } catch (\Exception $e) {
            //dd($e);
            return false;
        }
    }
    public function resetPassword(Request $request){
        $reset = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();
        if($reset){
            return view('user.users.reset')->with('email',$reset->email);
        }else{
            request()->session()->flash('error','El link para el password no se encuentra disponible');
            return redirect()->route('password.reset');
        }
    }
    public function passwordRecover(Request $request){
        $data2=$request->all();
        
        $user2 = DB::table('users')->where('email', $request->current_password)->select('id','name', 'email')->first();
        $user=User::findOrFail($user2->id);
        $data['password']=Hash::make($data2['new_password']);
        $status=$user->fill($data)->save();
        if($status){
            $resetpass = DB::table('password_resets')->where('email', $request->current_password);
            if ($resetpass) {
                $resetpass->delete();
            }
            request()->session()->flash('success','Password reiniciado Exitosamente');
            return redirect()->route('home');
        }else{
            request()->session()->flash('error','El link para el password no se encuentra disponible');
            return redirect()->route('password.reset');
        }
    }
    
    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    }
    
}
