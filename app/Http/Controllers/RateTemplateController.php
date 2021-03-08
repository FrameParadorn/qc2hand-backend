<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RateTemplate;

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
        "rateId" => $req->rateId
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
        $rateTemplateItemId = empty($req->rateTemplateItemId) ? 0 : $req->rateTemplateItemId;

        
        $rateTemplate = new RateTemplate;
        $rateTemplate->name = $name;
        $rateTemplate->display_type = $typeInput;
        $rateTemplate->model_type_id = $rateId;
        $ratetemplate->rate_template_item_id = $rateTemplateItemId;
        $rateTemplate->save();
        
        return back()->with('message', 'Create Successfully');
        
      }catch(Exception $e) {
        return back()->with('message', 'Create Fails');
      }
    }



    public function createItem(Request $req)
    {
        
      try {
        $name = $req->name;
        $price = $req->price;

        
        $rateTemplate = new RateTemplate;
        $rateTemplate->name = $name;
        $rateTemplate->display_type = $typeInput;
        $rateTemplate->model_type_id = $rateId;
        $rateTemplate->save();
        
        return back()->with('message', 'Create Successfully');
        
      }catch(Exception $e) {

        return back()->with('message', 'Create Fails');

      }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
