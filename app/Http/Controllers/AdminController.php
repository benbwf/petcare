<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Order;
use App\Admin;
use App\Pet;
use Image;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function showUsers(){
      $users = User::orderBy('created_at', 'asc')->paginate(10);//paginate with 10 per page
      return view('admin.users')->with('users', $users);
    }
    public function showUser($id){
      $user = User::find($id);//paginate with 10 per page
      $pets = $user->pets()->get();
      return view('admin.user')->with('user', $user)->with('pets', $pets);
    }
    public function showProducts(){
      $products = Product::orderBy('created_at', 'asc')->paginate(10);//paginate with 10 per page
      return view('admin.products')->with('products', $products);
    }
    public function showProduct($id){
      $product = Product::find($id);//paginate with 10 per page
      return view('admin.showProduct')->with('product', $product);
    }
    public function showOrders(){
      $orders = Order::orderBy('created_at', 'asc')->paginate(10);//paginate with 10 per page
      return view('admin.orders')->with('orders', $orders);
    }
    public function showOrder($id){
      $order = Order::find($id);//paginate with 10 per page
      $order->cart = unserialize($order->cart);
      return view('admin.showOrder')->with('order', $order);
    }

    public function update(Request $request)
    {
       if($request->hasFile('profile_img')){
            $profile_img = $request->file('profile_img');
            $filename = time() . '.' . $profile_img->getClientOriginalExtension();
            Image::make($profile_img)->resize(300,300)->save( public_path('/storage/profile_img/' .$filename ));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        $user_id = auth()->user()->id;
        $users = Admin::find($user_id);
         $users = Auth::user();
        return view('/admin');
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
         if ($user->profile_img !='default.jpg')//if pet image exists
         {
           //Delete Image
           Storage::delete('/storage/profile_img/'. $user->profile_img);
         }
         $pets = $user->pets()->get();
        $user->delete();
        foreach($pets as $pet){
          $pet->delete();
        }
        return redirect('/admin/users')->with('success', 'User Deleted');
    }

    public function destroyProduct($id)
     {
        $product = Product::find($id);
        //if (auth()->user()->id != $post->user_id){
         // return redirect('/posts')->with('error', 'You do not have permission to delete this post!');
       // }
        if ($product->product_image !='noimage.jpg')
        {
          //Delete Image
          Storage::delete('public/products_image/'.$product->product_image);
        }
        $product->delete();
        return redirect('/admin/products')->with('success', 'Product Removed');
    }



}
