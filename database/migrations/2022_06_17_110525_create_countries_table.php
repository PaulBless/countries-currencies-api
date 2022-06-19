<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_countries', function (Blueprint $table) {
            $table->id('country_id');
            $table->string('continent_code');
            $table->string('currency_code');
            $table->string('iso2_code');
            $table->string('iso3_code');
            $table->string('iso_numeric_code');
            $table->string('fips_code');
            $table->string('calling_code');
            $table->string('common_name');
            $table->string('official_name');
            $table->string('endonym');
            $table->string('demonym');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_countries');
    }
}
