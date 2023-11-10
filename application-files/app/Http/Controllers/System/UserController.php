<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\System\ResourceController;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
    }

    public function moduleName()
    {
        return 'users';
    }


    public function viewFolder()
    {
        return 'system.users';
    }

    public function formValidationRequest()
    {
        return 'App\Http\Requests\System\UserRequest';
    }

    // /**
    //  * Display a listing of the resource.
    //  */

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store()
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update($id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
