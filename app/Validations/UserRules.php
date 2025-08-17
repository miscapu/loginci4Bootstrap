<?php
namespace App\Validations;

use App\Models\UserModel;

class UserRules
{
    public function validateUser( string $str, string $fields, array $data )
    {
        $userModel  =   new UserModel();

        $user       =   $userModel->where( 'email', $data['emailFrm'] )->first();

        if ( !$user )
        {
            return false;
        }else
            {
                return password_verify($data['pwdFrm'], $user['password']);
            }
    }
}