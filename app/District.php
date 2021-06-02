<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
	protected $primaryKey = 'district_id';
	public $timestamps = false;

	public function getTableName(){
		return $this->table;
	}
}
