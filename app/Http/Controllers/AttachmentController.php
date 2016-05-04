<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Attachment;
use AccountUtil;
use Validator;

class AttachmentController extends Controller
{

    protected $resourceType, $resourceId;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setupResource($request);
        $attachments = AccountUtil::current()->attachments()
                            ->where('attachable_type', $this->resourceType)
                            ->where('attachable_id', $this->resourceId)->get();

        return response()->json($attachments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $this->setupResource($request);

        if(!$request->hasFile('file') && !$file->isValid()) {
            return response()->json(['result' => 'failure', 'errors' => $validator->errors()]);
        } else {
            $extension = $file->getClientOriginalExtension();
            $directory = storage_path() . "/app/attachments/{$this->resourceType}/{$this->resourceId}";
            $filename = sha1(time()) . ".{$extension}";
            $file->move($directory, $filename);

            $attachment = new Attachment;
            $attachment->attachable_type = $this->resourceType;
            $attachment->attachable_id = $this->resourceId;
            $attachment->attachment_url = $directory . '/' . $filename;
            $attachment->user_id = $request->user()->id;

            AccountUtil::current()->attachments()->save($attachment);

            return response()->json(['result' => 'success', 'attachment' => $attachment]);
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

    protected function setupResource($request)
    {
        $this->resourceType = $request->get('resourceType');
        $this->resourceId = $request->get('resourceId');
    }
}
