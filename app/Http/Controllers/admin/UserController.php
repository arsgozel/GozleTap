<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $objs = User::orderBy('username')
            ->get();

        return view('admin.user.index')
            ->with([
                'objs' => $objs,
                'permissions' => $this->getPermissions(),
            ]);
    }


    public function create()
    {
        return view('admin.user.create')
            ->with([
                'permissions' => $this->getPermissions(),
            ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')],
            'password' => ['required', Rules\Password::defaults()],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'integer', 'min:1'],
        ]);

        $obj = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'permissions' => $request->permissions ?: [],
        ]);

        return to_route('admin.users.index')
            ->with([
                'success' => trans('app.user') . ' (' . $obj->name . ') ' . trans('app.added') . '!'
            ]);
    }


    public function edit($id)
    {
        $obj = User::findOrFail($id);

        return view('admin.user.edit')
            ->with([
                'obj' => $obj,
                'permissions' => $this->getPermissions(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', Rules\Password::defaults()],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'integer', 'min:1'],
        ]);

        $obj = User::findOrFail($id);
        $obj->name = $request->name;
        $obj->username = $request->username;
        if (isset($request->password)) {
            $obj->password = Hash::make($request->password);
        }
        $obj->permissions = $request->permissions ?: [];
        $obj->update();

        return to_route('admin.users.index')
            ->with([
                'success' => trans('app.user') . ' (' . $obj->name . ') ' . trans('app.updated') . '!'
            ]);
    }


    public function destroy($id)
    {
        $obj = User::findOrFail($id);
        $objName = $obj->name;
        if ($obj->id == 1 or $obj->id == auth()->id()) {
            return redirect()->back()
                ->with([
                    'error' => trans('app.error') . '!'
                ]);
        }
        $obj->delete();

        return redirect()->back()
            ->with([
                'success' => trans('app.user') . ' (' . $objName . ') ' . trans('app.deleted') . '!'
            ]);
    }


    protected function getPermissions()
    {
        return [
            ['id' => 1, 'name' => trans('app.categories')],
            ['id' => 2, 'name' => trans('app.attributes')],
            ['id' => 3, 'name' => trans('app.jobs')],
            ['id' => 4, 'name' => trans('app.locations')],
            ['id' => 5, 'name' => trans('app.users')],
            ['id' => 6, 'name' => trans('app.authAttempts')],
            ['id' => 7, 'name' => trans('app.ipAddresses')],
            ['id' => 8, 'name' => trans('app.userAgents')],
            ['id' => 9, 'name' => trans('app.contacts')],
        ];
    }
}
