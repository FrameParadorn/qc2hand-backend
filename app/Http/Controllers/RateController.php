<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelType;
use App\RateTemplate;
use Illuminate\Support\Facades\Storage;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $types = ModelType::all();

      $args = [
        "types" => $types 
      ];

      return view("rate.index", $args);

    }



    public function show($id)
    {

      $type = ModelType::find($id);
      $rate = RateTemplate::where("model_type_id", $id)->get();

      $args = [
        "type" => $type,
        "rate" => $rate
      ];

      return view("rate.show", $args);
      
    }



    public function upload(Request $req, $id) {

      $uploadedFile = $req->file('file');
      $filename = $uploadedFile->getClientOriginalName();

      $path = $uploadedFile->store("public/image");
      $path = str_replace("public", "/storage", $path);

      $type = ModelType::find($id);
      $type->image = $path;
      $type->save();

    }

}
