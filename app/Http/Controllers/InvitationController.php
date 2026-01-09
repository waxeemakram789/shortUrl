<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function index()
{
    $authUser = auth()->user();

    if ($authUser->isMember()) {
        abort(403);
    }

    $adminRole  = Role::where('name', 'Admin')->first();
    $memberRole = Role::where('name', 'Member')->first();

    if ($authUser->isSuperAdmin()) {
        $users = User::with(['role', 'company'])->get();
    } else {
        $users = User::with(['role', 'company'])
            ->where('company_id', $authUser->company_id)
            ->get();
    }

    return view('invite.index', compact(
        'users',
        'adminRole',
        'memberRole'
    ));
}

    public function create()
    {
        $user = auth()->user();

        if (!($user->isSuperAdmin() || $user->isAdmin())) {
            abort(403);
        }

        return view('invite.create');
    }

    // public function store(Request $request)
    // {
    //     $authUser = auth()->user();

    //     if ($authUser->isSuperAdmin()) {

    //         if ($request->role !== 'Admin') {
    //             abort(403);
    //         }

    //         $request->validate([
    //             'name' => 'required',
    //             'email' => 'required|email|unique:users',
    //             'company_name' => 'required',
    //             'password' => 'required|min:6'
    //         ]);

    //         $company = Company::create([
    //             'name' => $request->company_name
    //         ]);

    //         $role = Role::where('name', 'Admin')->first();
            
    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => bcrypt($request->password),
    //             'company_id' => $company->id,
    //             'role_id' => $role->id
    //         ]);

    //         return back()->with('success', 'Admin invited successfully');
    //     }

    //     if ($authUser->isAdmin()) {

    //         if (!in_array($request->role, ['Admin', 'Member'])) {
    //             abort(403);
    //         }

    //         $request->validate([
    //             'name' => 'required',
    //             'email' => 'required|email|unique:users'
    //         ]);

    //         $role = Role::where('name', $request->role)->first();

    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => bcrypt('password'),
    //             'company_id' => $authUser->company_id,
    //             'role_id' => $role->id
    //         ]);

    //         return back()->with('success', 'User invited successfully');
    //     }

    //     abort(403);
    // }


    public function store(Request $request)
{
    $authUser = auth()->user();

    if ($authUser->isMember()) {
        abort(403);
    }

    $role = Role::where('name', $request->role_id)->first();

    if (!$role) {
        abort(403);
    }
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role_id' => 'required|string',
        'company_name' => 'required_if:role_id,Admin',
    ]);

    if ($authUser->isSuperAdmin()) {

        if ($request->role_id !== 'Admin') {
            abort(403);
        }

        $company = Company::create([
            'name' => $request->company_name,
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
            'company_id' => $company->id,
        ]);

        return redirect()->route('invite.index')->with('success', 'Admin invited');
    }

    if ($authUser->isAdmin()) {
        if (!in_array($request->role_id, ['Admin', 'Member'])) {
            abort(403);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
            'company_id' => $authUser->company_id,
        ]);

        return redirect()->route('invite.index')->with('success', 'User invited');
    }

    abort(403);
}
}
