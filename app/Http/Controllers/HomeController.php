<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\ProductDetails;
use App\Subcat;
use DB;
use Input;
use Counter;
use App\Star;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcomedata(){
      $productdetails = ProductDetails::where('quantity','!=',0)->orderBy('created_at','desc')->paginate(16);
      $category = Category::all();
      $subcat = Subcat::all();
      return view('welcome', ['productdetails' => $productdetails], ['category' => $category], ['subcat' => $subcat]);
    }
    public function notfound(){
      return view('layouts.errorpage');
    }
    public function filterwelcomedata(Request $request){
      $filter = $request->filter;
      if($filter==0){
        $productdetails = ProductDetails::where('quantity','!=',0)->orderBy('price','desc')->paginate(16);
      }
      elseif($filter==1){
        $productdetails = ProductDetails::where('quantity','!=',0)->orderBy('price','ASC')->paginate(16);
      }
      elseif($filter==2){
        $prod = ProductDetails::all();
        foreach($prod as $prod){
          $star = Star::all();
         foreach($star as $star){
           if(($prod->id) == ($star->product_id)){
             $productdetails = ProductDetails::where('quantity','!=',0)->orderBy('price','desc')->paginate(16);
           }
         }
      }
      }
      elseif($filter==3){
         $productdetails = ProductDetails::all();
      }
      return view('welcome', compact('productdetails'));
    }


    public function filteredproducts(Request $request){
      $numb = $request->numb;
      if($numb==0){
        $productdetails = ProductDetails::where('quantity','!=',0)->orderBy('created_at','desc')->take(20)->paginate(16);
      }
      elseif($numb==1){
        $star = Star::all();
        foreach($star as $star){
          $productdetails = ProductDetails::where('id',[$star->product_id])->paginate(4);
        }
      }
      elseif($numb=3){
        $user = User::where('role_id',4)->orWhere('role_id',2)->orWhere('role_id',3)->get();
        foreach($user as $user){
          $productdetails = ProductDetails::where('seller',[$user->id])->paginate(16);
        }
      }
      else{
        $productdetails = ProductDetails::where('quantity','!=',0)->orderBy('created_at','desc')->paginate(16);
      }
      return view('filteredproducts',compact('productdetails','category','subcat'));
    }
    
}
