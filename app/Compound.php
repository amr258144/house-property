<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    protected $table = 'compounds';
	protected $primaryKey = 'compound_id';
	public $timestamps = false;

	public function getTableName(){
		return $this->table;
	}
}
