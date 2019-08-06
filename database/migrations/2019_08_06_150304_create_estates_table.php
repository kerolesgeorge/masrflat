<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('neighbourhood_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('view_id');
            $table->unsignedBigInteger('finish_type_id');
            $table->decimal('area', 8, 2)->nullable();
            $table->integer('floor_number')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->integer('number_of_bathrooms')->nullable();
            $table->integer('number_of_living_spaces')->nullable();
            $table->integer('number_of_balconies')->nullable();
            $table->date('build_year')->nullable();
            $table->boolean('has_garage')->nullable();
            $table->boolean('has_elevator')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('neighbourhood_id')->references('id')->on('neighbourhoods');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('view_id')->references('id')->on('views');
            $table->foreign('finish_type_id')->references('id')->on('finish_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estates');
    }
}
