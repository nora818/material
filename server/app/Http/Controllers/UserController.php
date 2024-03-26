<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    protected $fieldList = [
        'name' => '',
        'email' => '',
        'created_at' => '',
    ];

    public function register()
    {
        return view("user/register");
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/product');
        }
        return view("user.login");
    }

    public function doLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect('/product');
        }

        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect('/login')->withErrors(["Warning!"]);
            }
            $request->session()->regenerate();
            return redirect('/product');
        }
        return redirect('/login')->withErrors(["Warning!"]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }


    public function index(Request $request)
    {
        return view('user.index', ['users' => User::all()]);
    }

    public function create(Request $request)
    {
        $data = $this->fieldList;
        return view('user.add', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:users', 'between:3,50'], // 确保用户名唯一
            'email' => ['required', 'email', 'unique:users'], // 确保邮箱唯一
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        $data['password'] = bcrypt($data['password']);

        // 创建用户
        User::create($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'Create user successful');
    }


    public function edit(Request $request, $id)
    {
        $user = user::findOrFail($id);

        $fieldNames = array_keys($this->fieldList);

        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $user->{$field};
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        return view('user.edit', $fields);
    }


    public function update(Request $request, $id)
    {
        $user = user::findOrFail($id);

        $auth = Auth::user();
        if ($user->name == 'admin' && $auth->name != 'admin') {
            return redirect()
                ->route('user.index')
                ->withErrors(['admin不允许别人编辑']);
        }
        $rules = [
            'name' => ['required', 'unique:users,name,' . $user->id, 'between:3,50'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ];

        if ($request->filled('password')) {
            $rules['password'] = [Password::min(6)];
        }

        $data = $request->validate($rules);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->fill($data);
        $user->save();
        return redirect()
            ->route('user.index')
            ->with('success', 'User edited successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_admin) {
            return redirect()
                ->route('user.index')
                ->withErrors(['admin delete not allowed']);
        }

        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
