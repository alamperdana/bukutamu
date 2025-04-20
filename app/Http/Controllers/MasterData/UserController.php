<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\UserDataTable;
use App\Http\Requests\MasterData\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('pages.master-data.user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.user-form', [
            'data' => new User(),
            'action' => route('master-data.users.store'),
            'roles' => Role::get()->pluck('name', 'name'),
            'satkers' => Satker::all('kode_satker', 'name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request, User $user)
    {
        $kode_satker = explode(' - ', $request->kode_satker)[0];

        $user->fill($request->only(['email', 'name', 'username']));
        $user->kode_satker = $kode_satker;
        $user->password = bcrypt($request->password);

        $user->markEmailAsVerified();
        $user->save();
        $user->assignRole($request->roles);

        return responseSuccess(false);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Role $role)
    {
        $lastLoginHumanReadable = $user->last_login
        ? Carbon::parse($user->last_login)->diffForHumans()
        : 'Belum pernah login';
        
        return view('pages.master-data.user-form', [
            'data' => $user,
            'last_login' => $lastLoginHumanReadable,
            'isReadonly' => true,
            'roles' => Role::get()->pluck('name', 'name'),
            'satkers' => Satker::all('kode_satker', 'name')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.master-data.user-form', [
            'data' => $user,
            'action' => route('master-data.users.update', $user->id),
            'roles' => Role::get()->pluck('name', 'name'),
            'satkers' => Satker::all('kode_satker', 'name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $kode_satker = explode(' - ', $request->kode_satker)[0];

        $user->fill($request->only(['email', 'name', 'username']));
        $user->kode_satker = $kode_satker;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        $user->syncRoles($request->roles);

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return responseSuccessDelete();
    }
}
