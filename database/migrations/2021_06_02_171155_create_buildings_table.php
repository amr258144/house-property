<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->bigIncrements('building_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('compound_id');
            $table->string('name');
            $table->string('a_name')->charset('utf8')->collation('utf8_general_ci');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('district_id')->references('district_id')->on('districts')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('compound_id')->references('compound_id')->on('compounds')->onDelete('RESTRICT')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
