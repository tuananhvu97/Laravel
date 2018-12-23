<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserActivation extends Model
{
    protected $table = 'user_activations';

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    private function regenerateToken($user)
    {

        $activation_code = $this->getToken();
        UserActivation::where('user_id', $user->id)->update([
            'activation_code' => $activation_code,
            'created_at' => new Carbon()
        ]);
        return $activation_code;
    }

    private function createToken($user)
    {
        $activation_code = $this->getToken();
        UserActivation::insert([
            'user_id' => $user->id,
            'activation_code' => $activation_code,
            'created_at' => new Carbon()
        ]);
        return $activation_code;
    }

    public function getActivation($user)
    {
        return UserActivation::where('user_id', $user->id)->first();
    }

    public function getActivationByToken($activation_code)
    {
        return UserActivation::where('activation_code', $activation_code)->first();
    }

    public function deleteActivation($activation_code)
    {
        UserActivation::where('activation_code', $activation_code)->delete();
    }
}
