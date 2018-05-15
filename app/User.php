<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
	protected $table = 'user';
	protected $primaryKey = 'id';
    protected $fillable = ['id','name','createDate','email','password','emailReferred','confirmed','confirmationCode','ercWallet','country','identificationType','identification','identificationImage','selfie','birthdate','gender','confirmedChecks,tokenreferrals'];
    
    


}