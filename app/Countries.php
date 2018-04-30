<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries  extends Model{

	protected $table = 'countries';
	protected $primaryKey = 'id_country';
    protected $fillable = ['id_country','nombre','name','nom','iso2','iso3','phone_code','estado'];
    
    


}
