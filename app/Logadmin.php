<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logadmin  extends Model{

	protected $table = 'log_admin';
	protected $primaryKey = 'id';
    protected $fillable = ['id','id_user_admin','id_user ','previous_data','current_data','created'];
    
    


}
