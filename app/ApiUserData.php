<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class ApiUserData
{
    /**
     * @return array
     */
    public function getAllUsers()
    {
        $data = [];
        $users = Cache::remember('users', 24*60, function() {
            return User::all();
        });

        foreach ($users as $user) {
                    $data[] = [
                        'id' => $user->id,
                        'login' => $user->login,
                        'FIO' => $user->full_name,
                        'date_end' => $user->getSubscribeEnd($user->id),
                    ];
                }

        return $data;
    }

    /**
     * @param $id
     * @return array
     */
    public function getUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json('Пользователь не найден', 404);
        }

        $data = [
            'id' => $user->id,
            'login' => $user->login,
            'FIO' => $user->full_name,
            'date_end' => $user->getSubscribeEnd($user->id)
        ];

        return $data;

    }
}
