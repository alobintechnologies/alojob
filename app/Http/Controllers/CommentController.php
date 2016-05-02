<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
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
        $comments = AccountUtil::current()->comments()
                      ->where('commentable_type', $this->resourceType)
                      ->where('commentable_id', $this->resourceId)->paginate();

        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make([
          'comment' => 'required'
        ]);
        $this->setupResource($request);

        if(!$validator->fails($comment)) {
          return Response::json(['result' => 'failure', 'errors' => $validator->errors()]);
        } else {
          $comment = new Comment;
          $comment->commentable_type = $this->resourceType;
          $comment->commentable_id = $this->resourceId;
          $comment->comment = $request->get('comment');
          $comment->author_id = $request->user()->id;

          AccountUtil::current()->comments()->save($comment);
          return Response::json(['result' => 'success', 'comment' => $comment]);
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
        $comment = AccountUtil::current()->comments()->findOrFail($id);
        if($comment) {
            $comment->delete();
            return Response::json(['result' => 'success']);
        } else {
          return Response::json(['result' => 'failure']);
        }
    }

    protected function setupResource($request)
    {
        $this->resourceType = $request->get('resourceType');
        $this->resourceId = $request->get('resourceId');
    }
}
