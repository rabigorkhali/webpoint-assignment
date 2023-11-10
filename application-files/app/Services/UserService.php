<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService extends Service
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        $user = $this->model->create($data);
        return $user;
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');
        $update = $this->itemByIdentifier($id);
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);
        return $update;
    }

    public function delete($request, $id)
    {
        if (Auth::user()->id == $id) {
            $responseErrorData['alert-danger'] = 'Logged in user cannot be delete.';
            return $responseErrorData;
        }
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }
}
