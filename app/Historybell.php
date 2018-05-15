<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historybell  extends Model{

	protected $table = 'history_bell ';
	protected $primaryKey = 'id';
    protected $fillable = ['id','id_user_admin','valor_bell','created'];
    
    


}
