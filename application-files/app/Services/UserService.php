<?php

namespace App\Services;

use App\Events\UserSaved;
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
        event(new UserSaved($user, [
            'bio' => $data['bio'],
            'status' => $data['status'] ?? '1',
            'type' => $data['type'] ?? 'detail'
        ]));
        return $user;
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');
        $user = $this->itemByIdentifier($id);
        $user->fill($data)->save();
        event(new UserSaved($user, [
            'bio' => $data['bio'],
            'status' => $data['status'] ?? '1',
            'type' => $data['type'] ?? 'detail'
        ]));
        $newUserData = $this->itemByIdentifier($id);
        return $newUserData;
    }

    public function delete($request, $id)
    {
        if (Auth::user()->id == $id) {
            $responseErrorData['alert-danger'] = __('messages.delete_denied_custom_message', ['custom_message' => __('messages.is_user_logined')]);
            return $responseErrorData;
        }
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }
}
