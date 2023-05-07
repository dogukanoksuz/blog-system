<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
        DB::table('role_user')->insert(['role_id' => 3, 'user_id' => $user->id]);

        $users = User::paginate(15);
        $error = 'Başarıyla kaydedildi!';

        return view('admin.users', compact(['users', 'error']));
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
        $user = User::find($id);

        return view('admin.user_edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $req = $request->all();

        User::find($id)->update([
            'name' => $req['name'],
            'email' => $req['email'],
        ]);

        if (! empty($request->password)) {
            User::find($id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        DB::table('role_user')->where('user_id', $id)->delete();
        // Role_user
        foreach ($request->role as $role) {
            DB::table('role_user')->insert([
                'role_id' => $role,
                'user_id' => $id,
            ]);
        }

        $users = User::paginate(15);
        $error = 'Başarıyla düzenlendi!';

        return view('admin.users', compact(['users', 'error']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id === 1) {
            $users = User::paginate(15);
            $error = 'Root kullanıcıyı silemezsiniz!';

            return view('admin.users', compact(['users', 'error']));
        }

        try {
            User::destroy($id);
            DB::table('role_user')->where('user_id', $id)->delete();
            $error = 'Başarıyla silindi!';
        } catch (QueryException $e) {
            $error = 'Hata!'.$e;
        }

        $users = User::paginate(15);

        return view('admin.users', compact(['users', 'error']));
    }
}
