<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ModelType;
use App\RateTemplate;
use App\RateTemplateItem;
use App\Vote;

class RateController extends Controller
{

  private $models;
  private $templates;
  private $templateItems;

  public function findTemplate($findId, $resultItem) {
    foreach($this->templates AS $templateIndex => $template) {
      if($template->rate_template_item_id === $findId) {
        $this->findTemplateItem($template->id, $resultItem);
      }
    }
  }

  public function findTemplateItem($findId, $resultItem) {
    $i = sizeof($resultItem["text"]) + 1;
    foreach($this->templateItems AS $templateItemIndex => $templateItem) {
      if($templateItem->rate_template_id === $findId) {
        $resultItem["text"][$i] = $templateItem->name;
        if(empty($templateItem->price)){
          $this->findTemplate($templateItem->id,  $resultItem);
        }else {
          $results[] = $resultItem;
        }
      }
    }
  }


  public function getModelAllForDropdown(Request $req) {

      $results = [];

      $this->models = ModelType::all();
      $this->templates = RateTemplate::all();
      $this->templateItems = RateTemplateItem::all();


      foreach($this->models AS $modelIndex => $model) {
        $resultItem = [
          "id" => null,
          "text" => [$model->name]
        ];

        foreach($this->templates AS $templateIndex => $template) {
          if($model->id === $template->model_type_id) {
            $this->findTemplateItem($template->id, $resultItem);
          }
        }
      }

      dd($results);



  }



  public function getModelAll(Request $req){

    $id = $req->id;

    if(empty($id)) {
      $models = ModelType::select("id", "name", "image")->get();
    }else{
      $models = ModelType::select("id", "name", "image")->find($id);
    }
    return response()->json([
      "message" => "Load models success",
      "data" => $models
    ]);

  }



  public function getTypeAll(Request $req) {

    $id = $req->modelId;
    $itemId = $req->itemId;

    $type;
    if(empty($itemId)) {
      $type = RateTemplate::where("model_type_id", $id)->first();
    }else{
      $type = RateTemplate::where("rate_template_item_id", $itemId)->first();
      if(empty($type)) {
        return response()->json([
          "message" => "Load type success",
          "data" => []
        ]);
      }
    }

    $type->items = RateTemplateItem::where("rate_template_id", $type->id)->get();
    return response()->json([
      "message" => "Load type success",
      "data" => $type
    ]);

  }


  public function createVote(Request $req) {

    $itemId = $req->item;
    $agree = $req->agree;

    $vote = new Vote;
    $vote->agree = $agree;
    $vote->item_id = $itemId;
    $vote->save();

  }


}
