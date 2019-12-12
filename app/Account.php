<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use Auth;

class Account extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable,
        CanResetPassword;

        protected $table = 'account';
            protected $primaryKey = 'id_account';
            public $incrementing = false;
            public $remember_token = false;
            //public $timestamps = false;
            protected $fillable = ['id_account','fullname', 'email', 'm_name','password','confirm_password','role','phone','gender','address','profile_picture','term_and_condition'];
}
