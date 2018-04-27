<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model{

	protected $table = 'paises';
	protected $primaryKey = 'id_pais';
    protected $fillable = ['id_pais','nombre','name','nom','iso2','iso3','phone_code','estado'];
    
    


}