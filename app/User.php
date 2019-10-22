<?php

namespace App;

use DateTime;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['login', 'first_name', 'last_name', 'middle_name', 'email', 'password'];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return sprintf('%s %s %s', $this->first_name, $this->last_name, $this->middle_name);
    }

    /**
     * @param $user_id
     *
     * @return mixed
     */
    public function getSubscribeEnd($user_id)
    {
        $subscribe = DB::table('user_subscribe')->where('user_id', $user_id)->first();
        if (isset($subscribe->subscribe_end)) {
            return date('Y-m-d', $subscribe->subscribe_end);
        }

        return 'Нет подписки';
    }

    /**
     * @param $user_id
     * @param $subscribe_end
     */
    public function setSubscribeEnd($user_id, $subscribe_end)
    {
        $subscribe_end = (new DateTime($subscribe_end))->setTime(23, 59, 59);
        DB::table('user_subscribe')->updateOrInsert(
            ['user_id' => $user_id],
            ['subscribe_end' => $subscribe_end->getTimestamp()]);
    }

    /**
     * @param $user_id
     */
    public function deleteSubscribeEnd($user_id)
    {
        DB::table('user_subscribe')->where('user_id', $user_id)->delete();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getAllUsersWithSubscribes()
    {
        $users = DB::table('users')->leftJoin('user_subscribe', 'id', '=', 'user_id')->get();
        foreach ($users as $user) {
            if ($user->subscribe_end) {
                $user->subscribe_end = date('Y-m-d', $user->subscribe_end);
            } else {
                $user->subscribe_end = 'Подписка отсутствует';
            }
        }
        return $users;
    }
}
