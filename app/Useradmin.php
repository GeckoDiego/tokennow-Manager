<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useradmin  extends Model{

	protected $table = 'user_admin ';
	protected $primaryKey = 'id';
    protected $fillable = ['id','name','email ','password','created'];
    
    


}
