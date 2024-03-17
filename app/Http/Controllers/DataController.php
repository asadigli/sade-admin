<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDetails;
use App\Category;
use App\Subcat;
use Input;
use View;
use App\Tag;
use App\Seotag;
use App\Seodesc;
use DB;

class DataController extends Controller
{
    public function products(){
      $productdetails = ProductDetails::paginate(4);
      // $productdetails = ProductDetails::all();
      $category = Category::all();
      $subcat = Subcat::all();
      return view('products', ['productdetails' => $productdetails], ['category' => $category], ['subcat' => $subcat]);

    }
    public function filterdata(){
        $productdetails = ProductDetails::where(function($query){
          $min_price = Input::has('min_price') ? Input::get('min_price'): null;
          $max_price = Input::has('max_price') ? Input::get('max_price'): null;
          if(isset($min_price) && isset($max_price)){
            // $query->where('price', '>=' , $min_price)->where('price','<=' , $max_price);
          }
        })->get();
        return View::make('searchedproducts', compact(['productdetails']));
    }
    public function getsubcatID($id){
      $subcat = Subcat::find($id);
      $productdetails = ProductDetails::orderBy('created_at','desc')->where('subcat_id',$id)->where('quantity','!=','0')->get();
      return view('products',['subcat' => $subcat], ['productdetails' => $productdetails]);
    }
    // public function searchedproducts(Request $request){
    //     $tag = new Tag;
    //     $tag->tag_name = $request->search;
    //     $cat_id = $request->cate_id;
    //     $search = $request->search;
    //     if($request->cate_id == 0){
    //       $productdetails = ProductDetails::orderBy('created_at','desc')->where('productname','LIKE','%' .$search. '%')
    //       ->orWhere('features','LIKE','%' .$search. '%')
    //       ->get();
    //     }else{
    //       $productdetails = ProductDetails::orderBy('created_at','desc')
    //       ->where(function ($query) use ($search, $request){
    //             $query->where('category_id', '=', [$request->cate_id])
    //                   ->where('productname','LIKE','%' .$search. '%');
    //       })
    //       ->orWhere(function ($query) use ($search, $request){
    //             $query->where('category_id', '=', [$request->cate_id])
    //                   ->where('features','LIKE','%' .$search. '%');
    //       })->get();
    //     }
    //     $tag->save();
    //     return view('searchedproducts',compact('productdetails','search'));
    //
    // }
    public function metatags(){
      $seotag = Seotag::all();
      $metatitle = 'Meta Tags';
      $link = 'metatags';
      return view('meta-creation',['metatitle'=>$metatitle],['seotag' => $seotag]);
    }
    public function metadescriptions(){
      $metatitle = 'Meta Description';
      $seodesc = Seodesc::all();
      return view('meta-creation',['metatitle'=>$metatitle],['seodesc' => $seodesc]);
    }
    public function metatag($id){
      $seot = Seotag::find($id);
      $metatitle = 'Meta Tag';
      return view('meta-creation',['metatitle'=>$metatitle],['seot' => $seot]);
    }
    public function metadesc($id){
      $metatitle = 'Meta Desc';
      $seod = Seodesc::find($id);
      return view('meta-creation',['metatitle'=>$metatitle],['seod' => $seod]);
    }
    public function editmetadesc(Request $req, $id){
      $seod = Seodesc::find($id);
      $seod->description = $req->description;
      $seod->save();
      return redirect()->back()->with('success','Description changed.');
    }
    public function metatagcreation(){
      $metatitle = 'Add Meta Tag';
      $link = 'metatag-creation';
      return view('meta-creation',['metatitle'=>$metatitle],['link' => $link]);
    }
    public function metadesccreation(){
      $metatitle = 'Add Meta Description';
      $link = 'metadesc-creation';
      return view('meta-creation',['metatitle'=>$metatitle],['link' => $link]);
    }
    public function addnewtag(Request $req){
      $st = new Seotag;
      $st->tag=$req->tag;
      if($req->product_id != 0){
        $st->product_id = $req->product_id;
      }elseif($req->product_id == 0 && $req->news_id != 0){
        $st->news_id = $req->news_id;
      }elseif($req->product_id == 0 && $req->news_id == 0 && $req->subcategory_id != 0){
        $st->subcategory_id = $req->subcategory_id;
      }elseif($req->product_id == 0 && $req->news_id == 0 && $req->subcategory_id == 0 && $req->category_id != 0){
        $st->category_id = $req->category_id;
      }elseif($req->product_id == 0 && $req->news_id == 0 && $req->subcategory_id == 0 && $req->category_id == 0 && $req->page_id != 0){
        $st->page_id = $req->page_id;
      }
      $st->save();
      return redirect()->back()->with('warning','Meta Tag added.');
    }
    public function addnewdesc(Request $req){
        $sd = new Seodesc;
        $sd->description=$req->description;
        if($req->product_id != 0){
          $sd->product_id = $req->product_id;
        }elseif($req->product_id == 0 && $req->news_id != 0){
          $sd->news_id = $req->news_id;
        }elseif($req->product_id == 0 && $req->news_id == 0 && $req->subcategory_id != 0){
          $sd->subcategory_id = $req->subcategory_id;
        }elseif($req->product_id == 0 && $req->news_id == 0 && $req->subcategory_id == 0 && $req->category_id != 0){
          $sd->category_id = $req->category_id;
        }elseif($req->product_id == 0 && $req->news_id == 0 && $req->subcategory_id == 0 && $req->category_id == 0 && $req->page_id != 0){
          $sd->page_id = $req->page_id;
        }
        $sd->save();
        return redirect()->back()->with('success','Meta Description added.');
    }
    public function deletetag($id){
      DB::table('seotag')->where('id',$id)->delete();
      return redirect()->back()->with('danger','Tag deleted.');
    }
    public function deletedesc($id){
      DB::table('seodesc')->where('id',$id)->delete();
      return redirect()->back()->with('danger','Description deleted.');
    }
    public function c_update(){
      if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') {$p = "../../new_store";}else{$p = "../..";}
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://data.fixer.io/api/latest?access_key=11103cb6f05b6d5b0f2c4562beb694de&symbols=AZN,RUB,TRY,USD",
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json"
        ),
      ));
      curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      $res = curl_exec($curl);
      $response = json_decode($res,TRUE);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
        echo "Error: " . $err;
      } else {
        $ips = file_get_contents($p.'/public/ips.txt');
        $ips = json_decode($ips, TRUE);
        $ips[] = ['date' => date('Y-m-d H:i:s'), 'ip' => $_SERVER['REMOTE_ADDR']];
        $json = json_encode($ips);
        
        $rt = $response['rates'];
        $arr = array("AZN" => 1,"RUB" => $rt['AZN'] / $rt["RUB"],"TRY" => $rt['AZN'] / $rt["TRY"],"USD" => $rt['AZN'] / $rt["USD"],);
        file_put_contents($p.'/public/currency.json',json_encode($arr,true));
        file_put_contents($p.'/public/ips.txt',$json);
        $r = file_get_contents($p.'/public/currency.json');
        if (isJson($r)) {
          echo "success";
        }else{
          echo "not json";
        }
      }
    }
}
