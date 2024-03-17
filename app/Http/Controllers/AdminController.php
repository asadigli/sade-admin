<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Category;
use App\Subcat;
use App\User;
use App\ProductDetails;
use App\AdminProduct;
use App\Post;
use App\Helpdesklist;
use App\HelpDesk;
use App\BoostedProducts;
use App\Country;
use App\City;
use App\Phonecode;
use App\Poster;
use Image;
use App\Comment;
use App\News;
use App\Newscomment;
use App\Vipcomments;
use App\Contact;
use App\Tag;
use App\View;
use Carbon;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function notfound(){return view('404');}
    public function profiledata(){return view('admin-profile');}
    public function newproducts(){return view('admin.newproducts');}
    public function newsdelete($id){
      DB::table('news')->where('id',$id)->delete();
      return redirect()->back()->with('success','News Deleted.');
    }
    public function getmostviewedproducts(){
      $pros = ProductDetails::where('view','>',20)->orderBy('view','desc')->get();
      return view('viewpros',compact('pros'));
    }
    public function toaddnews(Request $req){
      $news = new News;
      $news->news_title = $req->news_title;
      $news->news_body = $req->news_body;
      $news->access_token = md5(microtime());
      $news->slug = make_slug($req->news_title);
      $imgArr=[];
      foreach ($req->pictures as $picture) {
                  $ext=$picture->getClientOriginalExtension();
                  if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='bmp')  {
                      $filename=time()+random_int(1, 10000000).'.'.$picture->getClientOriginalExtension();
                      $picture->move(public_path('../../public/uploads/n/'),$filename);
                      array_push($imgArr,$filename);
                  }
              }
      if(count($imgArr) == 3){
        $news->news_image_1=$imgArr[0];
        $news->news_image_2=$imgArr[1];
        $news->news_image_3=$imgArr[2];
      }elseif(count($imgArr) == 2){
        $news->news_image_1=$imgArr[0];
        $news->news_image_2=$imgArr[1];
      }elseif(count($imgArr) == 1){
        $news->news_image_1=$imgArr[0];
      }else{

      }
      $news->save();
      update_sitemap();
      return redirect()->back()->with('success','News added.');
    }
    public function location(){
      $country = Country::all();
      return view('admin.location', compact('country'));
    }
    public function getcitybyajax(Request $request){
      $city = City::select('name', 'id')->where('country_id', [$request->id])->get();
      return response()->json($city);
    }
    public function getphonecodebyajax(Request $request){
      $Phonecode = Phonecode::select('name', 'id')->where('country_id', [$request->id])->get();
      return response()->json($phonecode);
    }
    public function helpdeskcontrol(){
      $helpdesklist = Helpdesklist::all();
      $helpdesk = HelpDesk::orderBy('created_at','desc')->paginate(10);
      $contact = Contact::where('deleted_status',0)->orderBy('created_at','desc')->get();
      return view('helpdeskcontrol',compact('helpdesklist','helpdesk','contact'));
    }
    public function cntlist(Request $req){
      $c = Contact::where('deleted_status',0)->orderBy('created_at','desc')->take($req->numb)->get();
      $count = Contact::where('deleted_status',0)->where("read",0)->take($req->numb)->count();
      return response()->json(["res" => $c, 'count' => $count]);
    }
    public function helpdeskcontrol_deleted(Request $req){
      $c = Contact::where('deleted_status',1)->orderBy('created_at','desc')->take($req->numb)->get();
      $count = Contact::where('deleted_status',0)->where("read",0)->take($req->numb)->count();
      return response()->json(["res" => $c, 'count' => $count]);
    }
    public function helpdeskcontrol_sent(Request $req){
      $c = Contact::where('deleted_status',0)->where('sent',"!=",0)->orderBy('created_at','desc')->take($req->numb)->get();
      $count = Contact::where('deleted_status',0)->where("read",0)->take($req->numb)->count();
      return response()->json(["res" => $c, 'count' => $count]);
    }
    public function getcontdets(Request $req){
      $c = Contact::find($req->id);
      return $c;
    }
    // public function delete_contact($id){
    //   DB::table('contact')->where('id',$id)->delete();
    //   return redirect()->back()->with('danger','Contact deleted!');
    // }
    public function readcontact(Request $req){
        $cn = Contact::find($req->id);
        if ($req->tp === "read") {$cn->read = 0;
        }else{$cn->read = 1;}
        $cn->update();
        return response()->json(["success" => "changed"]);
    }
    public function del_contact(Request $req){
      $c = Contact::find($req->id);
      if ($c->deleted_status == 0) {
        $c->deleted_status = 1;
      }else{
        $c->deleted_status = 0;
      }
      $c->update();
      return response()->json(["success" => "deleted"]);
    }
    public function deleteallcont(Request $req, $id){
      foreach($conts as $cont){
        $contact = Contact::where('id',[$cont->id])->first();
        $contact->deleted_status = $req->deleted_status;
      }
      $contact->update();
      return redirect()->back();
    }
    public function undeletecont(Request $req, $id){
      $contact = Contact::find($id);
      $contact->deleted_status = 0;
      $contact->update();
      return redirect()->back();
    }
    public function helpchat($id){
      $helpdesk = HelpDesk::find($id);
      return view('admin.helpdeskchat',['helpdesk' => $helpdesk]);
    }
    public function helpdeskreply(Request $request){
      $helpdesk = new HelpDesk;
      $helpdesk['created_at'] = new \DateTime();
      $helpdesk->user_id = $request->user_id;
      $helpdesk->reply_id = $request->reply_id;
      $helpdesk->problem_id = $request->problem_id;
      $helpdesk->problem_title = $request->problem_title;
      $helpdesk->problem_body = $request->problem_body;
      $helpdesk->item_id = $request->item_id;
      $helpdesk->reply_id = $request->reply_id;
      $helpdesk->reply_user_id = $request->reply_user_id;
      $helpdesk->save();
      return redirect()->back()->with('success','You have replied successfully!');
    }
    public function deletehelpmessage($id){
      DB::table('helpdesk')->where('id',$id)->delete();
      return redirect()->back();
    }
    public function Displaydataforadmin(){
      $posts = Post::all();
      $users = User::all();
      $unique_tags = DB::select(DB::raw('SELECT DISTINCT tag_name FROM tag'));
      $tag = Tag::all();
      $tag_tot = 0;
      foreach ($tag as $key => $t) {
        $tag_tot += $t->count;
      }
      $view_pro = DB::table('productdetails')->sum('view');
      $v_cat = View::where('cat_id','!=','0')->count();
      $v_news = View::where('news_id','!=','0')->count();
      $v_page = View::where('page_id','!=','0')->count();
      $v_subcat = View::where('subcat_id','!=','0')->count();
      $view_pro_today = DB::table('productdetails')->whereDate('updated_at', Carbon::today())->sum('view');
      $productdetails = ProductDetails::all();
      $subcat = Subcat::all();
      $cats = Category::all();
      $subcats = Subcat::all();
      $comments = Newscomment::where('verify','=',1)->get();
      $category = Category::all();$curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sade.asgro.org/api/get-product-details/".md5(date("d-M-Y")."999").md5(date("Y-m-d")."111"),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json"
        ),
      ));
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $res = curl_exec($curl);
      $response = json_decode($res,true);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        foreach ($productdetails as $k => $prod) {
          foreach ($response as $ke => $p) {
            if ($prod->main_id == $p['pro_id']) {
              $pro = ProductDetails::where('main_id',$prod->main_id)->first();
              $pro->quantity = $p['quantity'];
              $pro->discount = $pro->price - $p['price'];
              $pro->update();
            }
          }
        }
      }
      return view('index', compact('users','v_cat','v_subcat','v_news','v_page','view_pro','view_pro_today','tag_tot','unique_tags','cats','subcat','tag','posts','productdetails','subcat','category','comments'));
    }
    public function deleteproduct($id){
      DB::table('productdetails')->where('id',$id)->delete();
      return redirect('/adm/productlist')->with('success','Product successfully deleted!');
    }
    public function userlists(){
      $user = User::all();
      return view('admin.adminlisting', ['user' => $user]);
    }
    public function gettask(){
      return view('admin.task');
    }
    public function newslist(){
      $news = News::all();
      return view('newslist',['news'=>$news]);
    }
    public function editnews(Request $req, $id){
      $news = News::find($id);
      $news->news_title = $req->title;
      $news->news_body = $req->body;
      $news->slug = make_slug($req->slug);
      $news->access_token = md5(microtime());
      $news->update();
      update_sitemap();
      return redirect()->back()->with('success','News updated.');
    }
    public function assignadmin(Request $request, $id){
      $user = User::find($id);
      $user->role_id = $request->role_id;
      $user->access_token = md5(microtime());
      $user->update();
      return redirect()->back()->with('success','User setting has been changed.');
    }
    public function catcreation(Request $request){
        $this->validate($request, [
          'name' => 'required|min:3|unique:category',
        ]);
        $category = new Category;
        $category->name = $request->name;
        if($request->hasFile('poster')){
          $poster = $request->file('poster');
          $filename = time() . '.' . $poster->getClientOriginalExtension();
          $poster->move(public_path('../../public/uploads/ph/ct/'),$filename);
          $category->poster = $filename;
        }
        $category->slug = make_slug($request->name);
        $category->access_token = md5(microtime());
        $category->save();
        update_sitemap();
        return redirect()->route('catcr')->with('success','Category successfully added to store!');
    }
    public function addproblem(Request $request){
      $helpdesklist = new Helpdesklist;
      $helpdesklist->problem_list = $request->problem_list;
      $helpdesklist->save();
      return redirect()->back()->with('success','Problem successfully added to store!');
    }
    public function addnewcategory(){
      $category = Category::all();
      return view('catcreation', compact('category'));
    }
    public function getuserlist(){
      $user = User::orderBy("created_at","desc")->get();
      return view('userlist', compact('user'));
    }
    public function verify_number($user){
      $us = User::find($user);
      if ($us->mobile_verification == 0) {
        // echo "true"; exit();
        $us->mobile_verification = 1;
      }else{
        // echo "false"; exit();
        $us->mobile_verification = 0;
      }
      $us->update();
      // echo $us; exit();
      return redirect()->back()->with("success","Nömrə təsdiqləndi");
    }
    public function addnewsubcat(Request $request){
      $this->validate($request, [
        'subname' => 'required|min:3',
      ]);
      $subcat = new Subcat;
      $subcat->name = $request->subname;
      $subcat->slug = make_slug($request->subname);
      $subcat->parent_id = $request->parent_id;
      if($request->hasFile('poster')){
        $poster = $request->file('poster');
        $filename = time() . '.' . $poster->getClientOriginalExtension();
        $poster->move(public_path('../../public/uploads/ph/sct/'),$filename);
        $subcat->poster = $filename;
      }
      $subcat->access_token = md5(microtime());
      $subcat->save();
      update_sitemap();
      return redirect()->route('catcr')->with('success','New sub-category successfully adde.');
    }
    public function getDataforcatlists(){
      $category = Category::all();
      $subcat = Subcat::all();
      return view('catlists', ['category' => $category], ['subcat' => $subcat]);
    }
    public function getdatabyaj(Request $request){
      $data = Subcat::select('name', 'id')->where('parent_id', $request->id)->take(100)->get();
      return response()->json($data);
    }
    public function deleteuser($id){
        DB::table('users')->where('id',$id)->delete();
        return redirect()->back()->with('success','User deleted.');
      }
    public function getactivity(){
      $boostedproducts = BoostedProducts::orderBy('created_at','desc')->get();
      return view('boostedlist',compact('boostedproducts'));
    }
    public function addnews(){
      return view('addnews');
    }

    // ADD POSTER Here
        public function addposter(Request $request){
          $pstr = new Poster;
          $pstr->user_id = $request->user_id;
          $pstr->product_id = $request->product_id;
          $pstr->item_id=$request->item_id;
          $pstr->time=$request->time;
          if($request->hasFile('poster')){
            $poster = $request->file('poster');
            $filename = time() . '.' . $poster->getClientOriginalExtension();
            $poster->move(public_path('../../public/uploads/propo/'),$filename);
            $pstr->poster = $filename;
          }
          $pstr->save();
          return redirect()->back()->with('success','You have added a new poster.');
        }
        public function deleteposter(Request $request, $id){
          DB::table('poster')->where('id',$id)->delete();
          return redirect()->back()->with('success','Poster deleted.');
        }

        // END OF ADD POSTER SECTION

        public function unverified(){
          return view('unverifiedcomments');
        }
        public function verified(){
          return view('verifiedcomments');
        }
        public function rejectnewscomment($id){
          DB::table('newscomment')->where('id',$id)->delete();
          return redirect()->back()->with('danger','Rəy silindi');
        }
        public function verifynewscomment(Request $req, $id){
          $newscomment = Newscomment::find($id);
          $newscomment->verify = $req->verify;
          $newscomment->update();
          return redirect()->back()->with('success','Rəy Əlavə edildi.');
        }
        public function vipcomments(){
          return view('vipcomments');
        }
        public function addvipcomment(Request $req){
          $vp = new VipComments;
          $vp->message = $req->message;
          $vp->name = $req->name;
          $vp->surname = $req->surname;
          $vp->rating = $req->rating;
          $vp->save();
          return redirect()->back()->with('success','VIP rəy yaradıldı.');
        }
        public function deletevipcomment($id){
          DB::table('vipcomments')->where('id',$id)->delete();
          return redirect()->back()->with('danger','VİP rəy silindi');
        }
        public function usercreation(){
          return view('adduser');
        }
        public function adduser(Request $req){
          $this->validate($req, [
              'name' => 'required|string|max:255',
              'surname' => 'required|string|max:255',
              'role_id' => 'required|integer',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:6|confirmed',
          ]);
          $user = new User;
          $user->name = $req->name;
          $user->surname = $req->surname;
          $user->role_id = $req->role_id;
          $user->email = $req->email;
          $user->gender = $req->gender;
          $user->dob = $req->dob;
          $user->password = bcrypt($req->password);
          $user->access_token = md5(microtime());
          $user->save();
          return Redirect()->back()->with('success','User added!');
        }
        public function problemlists(){
          return view('problem_list');
        }
}
