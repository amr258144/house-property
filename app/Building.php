<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
	protected $primaryKey = 'building_id';
	public $timestamps = false;

	public function getTableName(){
		return $this->table;
	}
}
