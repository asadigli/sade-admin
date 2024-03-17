<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Contact;
use Illuminate\Http\Request;
use App\News;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getcontact(Request $req){
      $cont = new Contact;
      $cont->name = $req->name;
      $cont->surname = $req->surname;
      $cont->email = $req->email;
      $cont->phone_number = $req->phone_number;
      $cont->problem_title = $req->problem_title;
      $cont->problem_body = $req->problem_body;
      $cont->save();
      return redirect()->back()->with('success','Your message has been sent, you get reply very soon.');
    }
    // public function make_slug($word){
    //   $word = str_replace(array("ü","Ü"),"u",$word);
    //   $word = str_replace(array("Ə","ə"),"e",$word);
    //   $word = str_replace(array("Ö","ö"),"o",$word);
    //   $word = str_replace(array("Ş","ş"),"sh",$word);
    //   $word = str_replace(array("Ç","ç"),"ch",$word);
    //   $word = str_replace("İ","i",$word);
    //   $word = str_slug($word);
    //   echo $word;
    // }
}
