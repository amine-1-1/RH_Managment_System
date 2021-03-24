<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Role;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (Auth::user()->role_id == 1) {
            $roles = Role::all();
        } else {
            $roles = Role::where('id', '!=', 1)->get();
        }
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'required|email|max:255|unique:users',
            'role_id' => 'required|min:1|integer',
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');
        $role = $request->input('role_id');
        $password = Str::random(10);


        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->role_id = $role;
        $user->password = Hash::make($password);
        $user->save();

        $data = [
            'subject' => "Creation de compte",
            'address_from' => (Auth::user()->email),
            'name_from' => (Auth::user()->last_name) . '' . (Auth::user()->first_name),
            'address_to' => $user->email,
            'name_to' => $user->first_name . ' ' . $user->last_name,
            'password_to' => ($password),
        ];
        $mail = new WelcomeMail($data);
        Mail::send($mail);

        return redirect()->route('admin.users.index')->with(['created' => true, 'firstname' => $user->first_name, 'lastname' => $user->last_name]);
    }

    public function editInfo($id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role_id == 1) {
            $roles = Role::all();
        } else {
            $roles = Role::where('id', '!=', 1)->get();
        }
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateInfo(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'string|required|max:20',
            'last_name' => 'string|required|max:20',
            'role_id' => 'required|min:1|integer',
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $role = $request->input('role_id');

        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->role_id = $role;

        $user->save();
        return redirect()->route('admin.users.index')->with(['profileUpdated' => true, 'firstname' => $user->first_name, 'lastname' => $user->last_name]);
    }
    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'new_password' => 'required|confirmed|min:8',

        ]);
        $password = $request->input('new_password');
        $user->password = Hash::make($password);
        $user->save();
        return redirect()->route('admin.users.index')->with(['passwordUpdated' => true, 'firstname' => $user->first_name, 'lastname' => $user->last_name]);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', '=', $email)->first();
        if ($user) {
            return response()->json(['exist' => true, 'email' => $email]);
        } else {
            return response()->json(['exist' => false, 'email' => $email]);
        }
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
