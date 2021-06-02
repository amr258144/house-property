<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	protected $table = 'property';
	protected $primaryKey = 'property_id';
	public $timestamps = false;

	public function getTableName(){
		return $this->table;
	}
}
