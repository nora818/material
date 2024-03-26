<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $fieldList = [
        'content' => '',
        'user_id' => '',
    ];

    public function __construct()
    {
        // $this->authorizeResource(Comment::class);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->is_admin) {
            $data = Comment::query()->with('user')->get();
        } else {
            $data = Comment::with('user')->where('user_id', $user->id)->get();
        }
        return view('comment/index', ['comments' => $data]);
    }

    public function create(Request $request)
    {
        $data = $this->fieldList;
        return view('comment/add', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required'],
        ]);

        $data = array_merge($data, [
        ]);
        $data['user_id'] = Auth::user()->id;
        $comment = Comment::create($data);
        return redirect()
            ->route('comment.index')
            ->with('success', 'Create successful');
    }


    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('edit', $comment);

        $fieldNames = array_keys($this->fieldList);
        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $comment->{$field};
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }
        return view('comment.edit', $fields);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('edit', $comment);

        $data = $request->validate([
            'content' => ['required'],
        ]);

        $data = array_merge($data, [
        ]);
        $comment->fill($data);
        $comment->save();
        return redirect()
            ->route('comment.index')
            ->with('success', '编辑成功');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('edit', $comment);
        $comment->delete();

        return redirect()
            ->route('comment.index')
            ->with('success', '删除成功');
    }
}
