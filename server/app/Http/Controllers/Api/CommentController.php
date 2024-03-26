<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Comment::query()->with(['user'])->orderBy('id', 'desc')->paginate();
        return $this->success($list);
    }

    public function userList()
    {
        $userId = Auth::id();
        $list = Comment::query()->with(['user'])->where('user_id', $userId)->orderBy('id', 'desc')->paginate();
        return $this->success($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $result = Comment::create($data);
        return $this->success($result, "Comment successful");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if ($comment->user_id != Auth::user()->id) {
            return $this->error("illegal deletion");
        }
        Comment::destroy($id);
        return $this->success();
    }
}
