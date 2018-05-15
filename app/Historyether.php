<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historyether  extends Model{

	protected $table = 'history_ether ';
	protected $primaryKey = 'id';
    protected $fillable = ['id','id_user_admin','valor_ether','created'];
    
    


}
