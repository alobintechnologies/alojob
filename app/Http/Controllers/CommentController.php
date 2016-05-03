<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use AccountUtil;
use Validator;

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
                      ->with('author')
                      ->where('commentable_type', $this->resourceType)
                      ->where('commentable_id', $this->resourceId)->get();

        return view('comments.comment', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'comment' => 'required'
        ]);
        $this->setupResource($request);

        if($validator->fails()) {
          return response()->json(['result' => 'failure', 'errors' => $validator->errors()]);
        } else {
          $comment = new Comment;
          $comment->commentable_type = $this->resourceType;
          $comment->commentable_id = $this->resourceId;
          $comment->comment = $request->get('comment');
          $comment->author_id = $request->user()->id;

          AccountUtil::current()->comments()->save($comment);
          return response()->json(['result' => 'success', 'comment' => $comment]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //$this->setupResource($request);
        $comment = AccountUtil::current()->comments()->with('author')->findOrFail($id);
        if($comment) {
          return view('comments.show', compact('comment')); //response()->json(['result' => 'success', 'comment' => $comment]);
        } else {
          return response()->json('');
        }
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
            return response()->json(['result' => 'success']);
        } else {
          return response()->json(['result' => 'failure']);
        }
    }

    protected function setupResource($request)
    {
        $this->resourceType = $request->get('resourceType');
        $this->resourceId = $request->get('resourceId');
    }
}
