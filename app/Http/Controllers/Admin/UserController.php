<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('Role', 'Asc')->Paginate(10);



        return view('admin.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }


    /**
     * Change user's role function.
     *
     *
     *
     */
    public function changeRole(Request $request)
    {
        $role_updated = USER::where('id', $request->id)->update(
            [
                'role' => $request->role,
            ]
        );

        if ($request->role == 'Admin') {
            $role = 'Administrateur';
        } else if ($request->role == 'User') {
            $role = 'Utilisateur';
        }

        if ($role_updated) {
            return ['success' => '"' . $request->name . '" est un ' . $role . '.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    public function delete(Request $request)
    {

        $user_deleted = User::where('id', $request->id)->delete();


        if ($user_deleted) {
            return ['success' => 'Un utilisateur a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }
}
