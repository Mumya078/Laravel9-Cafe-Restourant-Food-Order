<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Product;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public static function maincategorylist()
    {
        return Category::where('parent_id', '=', 0)->with('children')->get();
    }

    public function index()
    {
        $page='home';
        $sliderdata=Product::limit(4)->get();
        $productlist1=Product::limit(6)->get();
        $setting = Setting::first();
        $datalist = Faq::all();
        $data = Product::all();

        return view('home.index',[
            'page'=>$page,
            'setting'=>$setting,
            'sliderdata'=>$sliderdata,
            'productlist1'=>$productlist1,
            'datalist'=>$datalist,
            'data'=>$data
            ]);
    }

    public function aboutus()
    {
        $setting = Setting::first();
        return view('home.index',[
            'setting'=>$setting,
        ]);
    }

    public function storemessage(Request $request)
    {
        $data = new Message();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->subject = $request->input('subject');
        $data->message = $request->input('message');
        $data->ip=request()->ip();
        $data->save();

        return redirect()->route('index')->with('info','Your message has been sent,Thank you.');
    }

    public function deneme()
    {
        return view('home.deneme');
    }

    public function test()
    {
        return view('home.test');
    }

    public function menu()
    {
        //
        $data= $this->maincategorylist();
        return view('home.menu.menu',[
            'data' => $data


        ]);
        $data->parent_id = $request->parent_id;
    }


    public function submenu($id)
    {
        //
        $parent=Category::find($id);
        $data =   $parent->children;

        return view('home.menu.menu',[
            'data' => $data

        ]);
        $data->parent_id = $request->parent_id;
    }

    public function products($id)
    {

        $data = Category::find($id);
        $category = Category::find($id);
        $productlist1 = DB::table('products')->where('category_id', $id)->get();
        return view('home.menu.products',[
            'productlist1'=>$productlist1,
            'category'=>$category,
            'data'=>$data
        ]);
    }
    public function productdetail($id)
    {
        $data = Product::find($id);
        $productlist1 = DB::table('products')->where('category_id', $id)->get();
        $reviews = Comment::where('product_id',$id)->get();


        return view('home.menu.productdetail',[
            'data'=>$data,
            'productlist1'=>$productlist1,
            'reviews'=>$reviews

        ]);

    }
    public function faq()
    {
        $datalist = Faq::all();
        return view('home.index',[
            'datalist'=>$datalist
        ]);
    }
    public function storecomment(Request $request)
    {
        $data = new Comment();
        $data->user_id = Auth::id();
        $data->product_id = $request->input('product_id');
        $data->subject = $request->input('subject');
        $data->review = $request->input('review');
        $data->ip=request()->ip();
        $data->rate = $request->input('rate');
        $data->save();
       return redirect()->route('productdetail',['id'=>$request->input('product_id')])->with('success','Thank You');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginadmincheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}
