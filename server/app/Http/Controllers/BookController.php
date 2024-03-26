<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Policies\BookPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    protected $fieldList = [
        'name' => '',
        'author' => '',
        'thumb' => '',
        'introduction' => ''
    ];

    public function __construct()
    {
        // $this->authorizeResource(Book::class);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->is_admin) {
            $data = Book::query()->with('user')->get();
        } else {
            $data = Book::with('user')->where('user_id', $user->id)->get();
        }
        return view('book/index', ['books' => $data]);
    }

    public function create(Request $request)
    {
        $data = $this->fieldList;
        return view('book/add', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'author' => ['required']
        ]);

        $data = array_merge($data, [
            'thumb' => $request->input('thumb', ""),
            'introduction' => $request->input('introduction', "")
        ]);
        $data['user_id'] = Auth::user()->id;
        $book = Book::create($data);
        return redirect()
            ->route('book.index')
            ->with('success', 'Book created successfully');
    }


    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('edit', $book);

        $fieldNames = array_keys($this->fieldList);
        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $book->{$field};
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }
        return view('book.edit', $fields);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('edit', $book);

        $data = $request->validate([
            'name' => ['required'],
            'author' => ['required']
        ]);

        $data = array_merge($data, [
            'thumb' => $request->input('thumb', ""),
            'introduction' => $request->input('introduction', "")
        ]);
        $book->fill($data);
        $book->save();
        return redirect()
            ->route('book.index')
            ->with('success', 'Book editing successful');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('edit', $book);
        $book->delete();

        return redirect()
            ->route('book.index')
            ->with('success', 'Book deleted successfully');
    }
}
