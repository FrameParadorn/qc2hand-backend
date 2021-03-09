<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RateTemplate;
use App\RateTemplateItem;

class RateTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {

      $args = [
        "rateId" => $req->rateId,
        "subId" => $req->subId
      ];

      return view("rate-template.create", $args);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        
      try {
        $rateId = $req->rateId;
        $name = $req->name;
        $typeInput = $req->type;
        $rateTemplateItemId = empty($req->rateTemplateItemId) ? "0" : $req->rateTemplateItemId;
        
        $rateTemplate = new RateTemplate;
        $rateTemplate->name = $name;
        $rateTemplate->display_type = $typeInput;
        $rateTemplate->model_type_id = $rateId;

        if(!empty($req->subId)) {
          $rateTemplate->rate_template_item_id = $req->subId;
        }

        $rateTemplate->save();
        
        return redirect("/rate-template/$rateId/edit/" . $rateTemplate->id);
        
      }catch(Exception $e) {
        return back()->with('message', 'Create Fails');
      }
    }



    public function createItem(Request $req, $rateId, $typeId)
    {
        
      try {
        $name = $req->name;
        $price = $req->price;
        
        $rateTemplateItem = new RateTemplateItem;
        $rateTemplateItem->name = $name;
        $rateTemplateItem->price = $price;
        $rateTemplateItem->rate_template_id = $typeId;
        $rateTemplateItem->save();
        
        return redirect("/rate-template/$rateId/edit/$typeId");
        
      }catch(Exception $e) {

        return back()->with('message', 'Create Fails');

      }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rateId, $typeId)
    {

      $type = RateTemplate::find($typeId);
      $items = RateTemplateItem::where("rate_template_id", "=", $typeId)->get();

      $args = [
        "rateId" => $rateId,
        "type" => $type,
        "items" => $items
      ];

      return view("rate-template.update", $args);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $rateId, $typeId)
    {
        
      try {
        $rateTemplate = RateTemplate::find($typeId);
        $rateTemplate->name = $req->name;
        $rateTemplate->display_type = $req->type;
        $rateTemplate->save();

        return back()->with('message', 'Create successfully');

      }catch(Exception $e) {
        return back()->with('message', 'Create fails');
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
