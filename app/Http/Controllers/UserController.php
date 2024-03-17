<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Category;
use App\Subcat;
use App\ProductDetails;
use Image;
use Auth;
use App\News;
use App\HelpDesk;
use App\Helpdesklist;
use App\Wishlist;
use Storage;
use App\Newscomment;
use App\Page;
use App\Tab;
use App\Seodesc;
use App\Images;
use File;

class UserController extends Controller
{
      public function getuserdata($id){
        $user = User::find($id);
        $productdetails = ProductDetails::orderBy('created_at','desc')->where('seller',$id)->paginate(8);
        return view('layouts.userprofile',['user' => $user], ['productdetails' => $productdetails]);
      }
      public function changenewsslug(Request $req, $id){
        $news = News::find($id);
        $news->slug = make_slug($req->slug);
        $news->update();
        update_sitemap();
        return redirect()->back()->with('success','Slug changed.');
      }
      public function sendproblem(Request $request){
          $helpdesk = new HelpDesk;
          $helpdesk['created_at'] = new \DateTime();
          $helpdesk->user_id=$request->user_id;
          $helpdesk->problem_id=$request->problem_id;
          $helpdesk->problem_title=$request->problem_title;
          $helpdesk->problem_body = $request->problem_body;
          $helpdesk->save();
          return redirect()->back()->with('success','Administration will reply very soon')
              ->with('product_report','Thank you for informing us!')
              ->with('post_report','Thank you for informing us!')
              ->with('mess_sent','Message Sent');
      }
      public function getData(){
        $productdetails = ProductDetails::all();
        $category = Category::all();
        $subcat = Subcat::all();
        return view('sellproduct', ['productdetails' => $productdetails], ['category' => $category], ['subcat' => $subcat]);
      }
      public function profileedit(){
        $user = User::all();
        return view('layouts.profile_edit',compact('user'));
      }
      public function editprofile(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->surname= $request->surname;
        $user->dob = $request->dob;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->postalcode = $request->postalcode;
        $user->mobile = $request->mobile;
        $user->update();
        return Redirect()->back()->with('primary','You have changed your settings.');
      }
      public function editproduct(Request $request, $id){
        $productdetails = ProductDetails::find($id);
        $productdetails->productname = $request->productname;
        $productdetails->category_id = $request->cat_name;
        $productdetails->subcat_id = $request->subcategory_name;
        $productdetails->quantity= $request->quantity;
        $productdetails->price = $request->price;
        $productdetails->main_id = $request->main_id;
        $productdetails->discount = $request->discount;
        $productdetails->contact = $request->contact;
        $productdetails->brand = $request->brand;
        $productdetails->features = $request->features;
        $productdetails->releasedate = $request->releasedate;
        $productdetails->dimension = $request->dimension;
        $productdetails->descriptionname = $request->descriptionname;
        $productdetails->description=$request->description;
        $productdetails->descriptionname2=$request->descriptionname2;
        $productdetails->description2 = $request->description2;
        if (empty($request->slug)) {
          $productdetails->slug = make_slug($request->productname);
        }else{
          $productdetails->slug = make_slug($request->slug);
        }
        $productdetails->access_token = md5(microtime());
        $imgArr=[];
        if (isset($request->pictures)) {
          foreach ($request->pictures as $picture) {
              $ext=$picture->getClientOriginalExtension();
              if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='bmp')  {
                  $filename=time()+random_int(1, 1000000000).'.'.$picture->getClientOriginalExtension();
                  Image::make($picture)->resize(180, 199)->save('../../public/uploads/proph/small/'.$filename);
                  $picture->move(public_path('../../public/uploads/proph/'),$filename);
                  array_push($imgArr,$filename);
            }
          }
          $ims = Images::where('pro_id',$productdetails->id)->get();
          foreach ($ims as $key => $im) {
              $image_path = '../../public/uploads/proph/'.$im->image;
              if(File::exists($image_path)) {
                  File::delete($image_path);
              }
              $smpath = '../../public/uploads/proph/small/'.$im->image;
              if(File::exists($smpath)) {
                  File::delete($smpath);
              }
              DB::table('images')->where('id',$im->id)->delete();
          }
          for ($i=0; $i < count($imgArr); $i++) {
            $img = new Images;
            $img->pro_id = $id;
            $img->image = $imgArr[$i];
            $img->save();
          }
        }
        $productdetails->update();
        update_sitemap();
        return Redirect()->back()->with('success','Product settings changed.');
      }
      public function productedit($id){
        $productdetails = ProductDetails::find($id);
        $category = Category::all();
        return view('editproduct',compact('productdetails','category'));
      }
      public function addproduct(Request $request){
        $this->validate($request,[
          'main_id' => 'required|unique:productdetails',
          'productname' => 'required|unique:productdetails',
        ]);
        $productdetails = new ProductDetails;
        $productdetails['created_at'] = new \DateTime();
        $productdetails->category_id = $request->cat_name;
        $productdetails->seller = Auth::user()->id;
        $productdetails->subcat_id = $request->subcategory_name;
        $productdetails->productname = $request->productname;
        $productdetails->slug = make_slug($request->productname)."-".rand(10000000,20000000);
        $productdetails->discount = $request->discount;
        $productdetails->price = $request->price;
        $productdetails->currency = $request->currency;
        $productdetails->quantity = $request->quantity;
        $productdetails->contact = "+994558186601";
        $productdetails->brand = $request->brand;
        $productdetails->releasedate = $request->releasedate;
        $productdetails->country=$request->country;
        $productdetails->city=$request->city;
        $productdetails->dimension = $request->dimension;
        $productdetails->features = $request->features;
        $productdetails->condition = $request->condition;
        $productdetails->descriptionname = $request->descriptionname;
        $productdetails->description = $request->description;
        $productdetails->descriptionname2 = $request->descriptionname2;
        $productdetails->description2 = $request->description2;
        $productdetails->main_id  = $request->main_id;
        $productdetails->shipping_in_baku = $request->shipping_in_baku;
        $productdetails->shipping_to_regions = $request->shipping_to_regions;
        $productdetails->sadestore_points = $request->sadestore_points;
        $productdetails->buy_2_get_1 = $request->buy_2_get_1;
        $productdetails->access_token = md5(microtime());
        $imgArr=[];
        foreach ($request->pictures as $picture) {
            $ext=$picture->getClientOriginalExtension();
            if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='bmp')  {
                $filename=time()+random_int(1, 100000000).'.'.$picture->getClientOriginalExtension();
                Image::make($picture)->resize(180, 199)->save('../../public/uploads/proph/small/'.$filename);
                $picture->move(public_path('../../public/uploads/proph/'),$filename);
                array_push($imgArr,$filename);
          }
        }
        $productdetails->save();
        $sd = new Seodesc;
        $prod = ProductDetails::where('main_id',$request->main_id)->first();
        $sd->description = $request->productname;
        $sd->product_id = $prod->id;
        $sd->save();
        for ($i=0; $i < count($imgArr); $i++) {
          $img = new Images;
          $img->pro_id = $prod->id;
          $img->image = $imgArr[$i];
          $img->save();
        }
        update_sitemap();
        return redirect()->back()->with('success','Product added successfully.');
      }
      public function getdatabyajax(Request $request){
        $data = Subcat::select('name', 'id')->where('parent_id', $request->id)->take(100)->get();
        return response()->json($data);
      }
      public function update_avatar(Request $request){
        if($request->hasFile('avatar')){
          $avatar = $request->file('avatar');
          $filename = time() . '.' . $avatar->getClientOriginalExtension();
          Image::make($avatar)->resize(500, 500)->save(public_path('/uploads/av/' . $filename));
          $user = Auth::user();
          $user->avatar = $filename;
          $user->save();
        }
        return Redirect()->back()->with('success','Profile photo changed.');
      }
      public function addnewscomment(Request $req){
          $nc = new Newscomment;
          $nc->news_id = $req->news_id;
          $nc->name = $req->name;
          $nc->surname = $req->surname;
          $nc->email = $req->email;
          $nc->message = $req->message;
          $nc->product_id = $req->product_id;
          $nc->rating = $req->rating;
          $nc->save();
          return redirect()->back()->with('news_comment_added','Your comment will be added after checked by Administration');
      }
      public function changepassword(Request $req, $id){
        $this->validate($req,[
          'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::find($id);
        $user->password = Hash::make($req->password);
        $user->update();
        return Redirect()->back()->with('success','Password Changed.');
      }
      public function changeuserdata(Request $request, $id){
        $user = User::find($id);
        $this->validate($request, [
            'dob' => 'required',
            'email' => 'required|string|min:6|unique:users,email,' . $user->id,
            'name' => 'required|min:2',
            'surname' => 'required|min:2',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->surname = $request->surname;
        $user->dob = $request->dob;
        $user->update();
        return redirect()->back()->with('success','You have changed your settings.');
      }
      public function getpages(){
        $pages = Page::where('status','=',1)->get();
        $pages_na = Page::where('status', '=', 0)->get();
        return view('pagelist',compact('pages','pages_na'));
      }
      public function deletepage($token){
        DB::table('pages')->where('token',$token)->delete();
        return redirect()->back()->with('success','Page Deleted.');
      }
      public function createpage(){return view('pagecreation');}
      public function tocreatepage(Request $request){
        $page = new Page;
        $page->title = $request->title;
        $page->shortname = $request->shortname;
        if(empty($request->slug)){
          $page->slug = make_slug($request->title);
        }else{
          $this->validate($request, [
              'slug' => 'string|min:3|unique:pages',
          ]);
          $page->slug = $request->slug;
        }
        $page->token = md5(microtime());
        $page->footer_seem = $request->footer_seem;
        $page->information_footer = $request->in_fo;
        if($request->in_fo == 0){
          $page->guidance_footer = 1;
        }else{
          $page->guidance_footer = 0;
        }
        $page->header_seem = $request->header_seem;
        $page->status = $request->status;
        $page->details = $request->details;
        if($request->hasFile('image')){
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('../../public/uploads/pg/'),$filename);
          $page->image = $filename;
        }
        $page->save();
        update_sitemap();
        if(($request->status) == 0){
          return redirect()->back()->with('danger','Page created, but has not activated yet.');
        }else{
          return redirect()->back()->with('success','Page created.');
        }
      }
      public function editpageslug(Request $request, $id){
        $page = Page::find($id);
        $page->title = $request->title;
        if(empty($page->slug)){
          $page->slug = make_slug($request->title);
        }else{
          $this->validate($request, [
              'slug' => 'string|min:3|unique:pages,slug,' . $page->id,
          ]);
          $page->slug = $request->slug;
        }
        $page->footer_seem = $request->footer_seem;
        $page->header_seem = $request->header_seem;
        $page->status = $request->status;
        $page->update();
        update_sitemap();
        if(($request->status) == 0){
          return redirect()->back()->with('danger','Page set as not activated.');
        }else{
          return redirect()->back()->with('success','Page set as activated.');
        }
      }
      public function updatepages(Request $request, $id){
        $page = Page::find($id);
        $page->title = $request->title;
        $page->shortname = $request->shortname;
        if(empty($page->slug)){
          $page->slug = make_slug($request->title);
        }else{
          $this->validate($request, [
              'slug' => 'string|min:3|unique:pages,slug,' . $page->id,
          ]);
          $page->slug = $request->slug;
        }
        $page->footer_seem = $request->footer_seem;
        $page->information_footer = $request->in_fo;
        if($request->in_fo == 0){
          $page->guidance_footer = 1;
        }else{
          $page->guidance_footer = 0;
        }
        $page->header_seem = $request->header_seem;
        $page->details = $request->details;
        $page->status = $request->status;
        if($request->hasFile('image')){
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('../../public/uploads/pg/'),$filename);
          $page->image = $filename;
        }
        $page->update();
        update_sitemap();
        if(($request->status) == 0){
          return redirect()->back()->with('danger','Page set as not activated.');
        }else{
          return redirect()->back()->with('success','Page set as activated.');
        }
      }
      public function pageedit($slug){
         $page = DB::table('pages')->where('slug', $slug)->first();
         return view('page-edit',['page' => $page]);
      }
      public function tabslist(){
        $tabs = Tab::all();
        return view('tabs',['tabs'=>$tabs]);
      }
      public function createtab(Request $req){
        $tab = new Tab;
        $tab->page_id = $req->page_id;
        $tab->status = $req->status;
        $tab->question = $req->question;
        $tab->answer = $req->answer;
        $tab->save();
        return redirect()->back()->with('success','Tab created.');
      }
      public function edittab(Request $req, $id){
          $tab = Tab::find($id);
          $tab->status = $req->status;
          $tab->page_id = $req->page_id;
          $tab->question = $req->question;
          $tab->answer = $req->answer;
          $tab->update();
          return redirect('/tabscontrol')->with('success','Tab settings changed.');
      }
      public function deletetab($id){
        DB::table('tabs')->where('id',$id)->delete();
        return redirect()->back()->with('danger','Tab deleted.');
      }
      public function tabedit($id){
        $tab = Tab::find($id);
        return view('tab-edit',compact('tab'));
      }
      public function deleteUnusedImages(){
          $file_types = array('gif','jpg','jpeg','png');
          $directory = '../../public/uploads/proph/';
          $files = File::allFiles($directory);
          foreach ($files as $file){
              $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
              if (in_array($ext, $file_types)) {
                $imgs = Images::where('image',basename($file))->first();
                  if(!empty($imgs)){
                    echo "<b style='color:green;'>Exist</b> - ".basename($file)."<br>";
                  }else{
                    echo "<b style='color:red;'>removed</b> - ".basename($file)."<br />";
                    unlink($file);
                  }
              }
          }
      }
}
