<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{


  public function index(Request $req) {

    $blogs  = Blog::orderBy("id", "desc")->paginate(10);
     
    $data = [
      "blogs" => $blogs
    ];

    return view("blog.index", $data);

  }


  public function create(Request $req) {
    return view("blog.create");
  }


  public function store(Request $req) {

    $file = $req->file("cover");
    $filename = Str::uuid()->toString() . "." . $file->extension();
    $file->storeAs("public/image", $filename);

    $blog = new Blog();
    $blog->title = $req->title;
    $blog->content_web = $req->content_web;
    $blog->content_mobile = $req->content_mobile;
    $blog->cover = $filename;
    $blog->save();

    return redirect("/blog");

  }


  public function upload(Request $req) {
    $file = $req->file("file");
    $filename = Str::uuid()->toString() . "." . $file->extension();
    $file->storeAs("public/image", $filename);

    return $filename;
  }



  public function edit(Request $req, $id) {

    $data = [
      "blog" => Blog::find($id)
    ];

    return view("blog.edit", $data);

  }


  public function update(Request $req,  $id) {

    if(!empty($req->file("cover"))) {
      $file = $req->file("cover");
      $filename = Str::uuid()->toString() . "." . $file->extension();
      $file->storeAs("public/image", $filename);
    }

    $blog = Blog::find($id);
    $blog->title = empty($req->title) ? $blog->title : $req->title;
    $blog->cover = empty($req->file("cover")) ? $blog->cover : $filename;
    $blog->content_web = empty($req->content_web) ? $blog->content_web : $req->content_web;
    $blog->content_mobile = empty($req->content_mobile) ? $blog->content_mobile : $req->content_mobile;
    $blog->save();

    return back();

  }


  public function destroy(Request $req, $id) {

    Blog::find($id)->delete();

    return back();  

  }
  


}
