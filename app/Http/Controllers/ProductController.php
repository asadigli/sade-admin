<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Category;
use App\Subcat;
use App\ProductDetails;
use App\User;
use App\Message;
use App\Star;
use App\Prodtab;
use File;
use App\Images;
class ProductController extends Controller
{
  public function get_test(){
    update_sitemap();
    echo "ooo";
  }
  public function getData(){
    $productdetails = ProductDetails::all();
    $category = Category::all();
    $subcat = Subcat::all();
    return view('admin.form', ['productdetails' => $productdetails], ['category' => $category], ['subcat' => $subcat]);
  }
  public function getbyajax(){
    $category = Category::all();
    $subcat = Subcat::all();
    return view('admin.form');
  }
  public function getdatabyajax(Request $request){
    $data = Subcat::select('name', 'id')->where('parent_id', $request->id)->take(100)->get();
    return response()->json($data);
  }
  public function displaydata($productname){
    $productdetails = DB::table('productdetails')->where('productname', $productname)->first();
    $user = User::all();
    return view('product_details',compact('productdetails','user'));
  }
  public function showproducts(){
    $productdetails = ProductDetails::orderBy('created_at','desc')->get();
    $user = User::all();
    return view('productlist', compact('productdetails','user'));
  }
  public function deletecategory($id){
    DB::table('productdetails')->where('category_id',$id)->delete();
    DB::table('subcat')->where('parent_id',$id)->delete();
    DB::table('category')->where('id',$id)->delete();
    update_sitemap();
    return redirect()->back()->with('success','Category deleted!');
  }
  public function categoryedit(Request $req, $id){
    $cat = Category::find($id);
    $cat->name = $req->name;
    if(empty($req->slug)){
      $slug = make_slug($req->name);
    }else{
      $slug = make_slug($req->slug);
    }
    $cat->slug = $slug;
    if($req->hasFile('poster')){
      $poster = $req->file('poster');
      $filename = time() . '.' . $poster->getClientOriginalExtension();
      $poster->move(public_path('../../public/uploads/ph/ct/'),$filename);
      $cat->poster = $filename;
    }
    $cat->update();
    update_sitemap();
    return redirect()->back()->with('success','You have edited category.');
  }
  public function subcatedit(Request $req, $id){
    $sub = Subcat::find($id);
    $sub->name = $req->name;
    if(count($req->slug) == 0){
      $sub->slug = make_slug($req->name);
    }else{
      $sub->slug = make_slug($req->slug);
    }
    if($req->hasFile('poster')){
      $poster = $req->file('poster');
      $filename = time() . '.' . $poster->getClientOriginalExtension();
      $poster->move(public_path('../../public/uploads/ph/sct/'),$filename);
      $sub->poster = $filename;
    }
    $sub->update();
    update_sitemap();
    return redirect()->back()->with('success','You have edited sub-category.');
  }
  public function deletesubcat($id){
    DB::table('productdetails')->where('subcat_id',$id)->delete();
    DB::table('subcat')->where('id',$id)->delete();
    update_sitemap();
    return redirect()->back()->with('success','Sub-Category deleted.');
  }
  public function deleteproduct($id){
      $ims = Images::where('pro_id',$id)->get();
      foreach ($ims as $key => $im) {
        $image_path = '../../public/uploads/proph/'.$im->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $smpath = '../../public/uploads/proph/small/'.$im->image;
        if(File::exists($smpath)) {
            File::delete($smpath);
        }
      }
      update_sitemap();
      DB::table('productdetails')->where('id',$id)->delete();
      return redirect()->back()->with('success','Product deleted.');
  }

  public function editproduct($id){
    $productdetails = productdetails::find($id);
    return view('admin.editproduct',compact('productdetails'));
  }
  public function editproductslug(Request $req, $id){
    $prod = ProductDetails::find($id);
    $prod->productname = $req->name;
    if(empty($req->slug)){
      $prod->slug = make_slug($req->name);
    }else{
      $prod->slug = make_slug($req->slug);
    }
    $prod->update();
    update_sitemap();
    return redirect()->back()->with('success','Product Slug changed.');
  }
  public function givestar(Request $request){
    $star = new Star;
    $star->user_id=$request->user_id;
    $star->product_id=$request->product_id;
    $star->seller_id=$request->seller_id;
    $star->stars=$request->stars;
    $star->save();
    return redirect()->back();
    // $request->user()->productdetails()->save($star);
  }
  public function changestar(Request $request, $user_id){
    $star = Star::find($user_id);
    $star->stars = $request->stars;
    $star->update();
    return redirect()->back()->with('success','You have changed your post.');
  }
  public function prodtabs(){
    $title = 'Add Tab';
    return view('prodtab',['title'=>$title]);
  }
  public function prodtablist(){
    $prodtab = Prodtab::all();
    $pros = ProductDetails::all();
    $title = 'Tab List';
    return view('prodtab',compact('title','prodtab','pros'));
  }
  public function addproducttab(Request $req){
      $prodtab = new Prodtab;
      $prodtab->product_id = $req->product_id;
      $prodtab->title = $req->title;
      $prodtab->detail = $req->detail;
      $prodtab->save();
      return redirect()->back()->with('success','Tab Added.');
  }
  public function deleteproducttab($id){
      DB::table('prodtab')->where('id',$id)->delete();
      return redirect()->back()->with('danger','Tab deleted.');
  }
  public function editprod_tab(Request $req, $id){
      $prodtab = Prodtab::find($id);
      $prodtab->product_id = $req->product_id;
      $prodtab->title = $req->title;
      $prodtab->detail = $req->detail;
      $prodtab->update();
      return redirect()->back()->with('primary','Tab Changed.');
  }
}
