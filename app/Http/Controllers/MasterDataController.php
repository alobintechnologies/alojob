<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AccountUtil;
use App\Http\Requests;

class MasterDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($masterType, Request $request)
    {
        // TODO: list the master data type values
        $masterDatas = $this->currentMasterTypes($masterType)->paginate();
        return $masterDatas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($masterType, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        if($validator->fails()) {
            return Response::json(['result' => 'failure', 'error' => $validator->errors()]);
        }
        $masterData = new stdClass;//{"\\App\\".$masterType}();
        $masterData->title = $request->input('title');
        $masterData->account_id = AccountUtil::current()->id;
        $this->currentMasterTypes($masterType)->save($masterData);

        return $masterData;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($masterType, Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        if($validator->fails()) {
            return Response::json(['result' => 'failure', 'error' => $validator->errors()]);
        }
        $masterData = $this->currentMasterTypes($masterType)->findOrFail($id);
        $masterData->title = $request->input('title');
        $this->currentMasterTypes($masterType)->save($masterData);

        return $masterData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masterData = $this->currentMasterTypes($masterType)->findOrFail($id);
        if($masterData) {
            $masterData->delete();
        }
    }

    public function currentMasterTypes($masterType)
    {
        //$pluralMasterType = snake_case(str_plural($masterType));
        return AccountUtil::current()->{$masterType}();
    }
}
