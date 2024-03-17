<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use App\HelpDesk;
use Image;
use DB;
use Storage;
use App\Message;
use App\Like;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
  public function posts($id){
    $user = User::all();
    $post = Post::find($id);
    $comment = Comment::orderBy('created_at','desc')->get();
    $helpdesk = HelpDesk::all();
    return view('blog', compact('user','post','comment','helpdesk'));
  }
  public function writepost(Request $request){
    $post = new Post();
    $posts['created_at'] = new \DateTime();
    $post->user_id = $request->user_id;
    $post->body=$request->body;
    // $post->images = $request->images;
    if($request->hasFile('images')){
      $images = $request->file('images');
      $filename = time() . '.' . $images->getClientOriginalExtension();
      Image::make($images)->save(public_path('../../public/uploads/poph/' . $filename));
      $post->images = $filename;
      // $photos = $request->file('photos');
      // $filename = $photos->getClientOriginalName();
      // Storage::put('upload/images/' .$filename, file_get_contents($request->file('images')->getRealPath()));
      //
      // $productdetails->photos=$filename;

    }
    $request->user()->posts()->save($post);
    return redirect()->route('community');
  }
  public function writecomment(Request $request){
    $comment = new Comment();
    // $comment = Comment::orderBy('created_at','desc');
    // $posts['created_at'] = new \DateTime();
    $comment->user_id = $request->user_id;
    $comment->post_id = $request->post_id;
    $comment->body=$request->body;
    $request->user()->comments()->save($comment);
    return redirect()->route('community');
    // return response()->jsdon($send);

  }
  public function sendmessage(Request $request){
    $message = new Message();
    $message->user_id = $request->user_id;
    $message->user_email = $request->user_email;
    $message->message_body=$request->message_body;
    $message->reply_id=$request->reply_id;
    $request->user()->message()->save($message);
    return redirect()->back();
  }
  public function messagedelete($id){
    DB::table('message')->where('id',$id)->delete();
    return redirect()->back()->with('danger','Message deleted.');
  }

  public function commentdelete($id){
    DB::table('comments')->where('id',$id)->delete();
    return redirect()->back()->with('danger','Comment deleted.');
  }
  public function postdelete($id){
    DB::table('posts')->where('id',$id)->delete();
    return redirect()->back()->with('danger','Post deleted.');
  }
  public function editpost(Request $request, $id){
    $post = Post::find($id);
    $post->body = $request->body;
    $post->update();
    return redirect('/community')->with('primary','You have changed your post.');
  }
  public function editcomment(Request $request, $id){
    $comment = Comment::find($id);
    $comment->body = $request->body;
    $comment->update();
    return redirect('/community')->with('primary','You have changed your post.');
  }
  public function likeProduct($id)
    {
        // here you can check if product exists or is valid or whatever
        $this->handleLike('App\ProductDetails', $id);
        return redirect()->back();
    }
    public function likePost($id)
    {
        // here you can check if product exists or is valid or whatever
        $this->handleLike('App\Post', $id);
        return redirect()->back();
    }
    public function handleLike($type, $id)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();
        if (is_null($existing_like)) {
            Like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }

}
