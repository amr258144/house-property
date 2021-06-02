<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('property_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('compound_id');
            $table->unsignedBigInteger('building_id');
            $table->unsignedBigInteger('promotion_id');
            $table->string('name');
            $table->string('a_name')->charset('utf8')->collation('utf8_general_ci');
            $table->unsignedInteger('no_bathrooms')->default('0');
            $table->unsignedInteger('no_bedrooms')->default('0');
            $table->unsignedInteger('no_guest_rooms')->default('0');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('district_id')->references('district_id')->on('districts')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('compound_id')->references('compound_id')->on('compounds')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('building_id')->references('building_id')->on('buildings')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('promotion_id')->references('promotion_id')->on('promotions')->onDelete('RESTRICT')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
