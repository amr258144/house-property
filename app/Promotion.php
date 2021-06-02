<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
	protected $primaryKey = 'promotion_id';
	public $timestamps = false;

	public function getTableName(){
		return $this->table;
	}
}
