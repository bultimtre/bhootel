<?php

use Carbon\Traits\Timestamp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('address');
            $table->decimal('lat', 10, 8)->nullable();  //temp nullable
            $table->decimal('lon', 11, 8)->nullable();
            $table->smallInteger('rooms');
            $table->smallInteger('beds');
            $table->smallInteger('bath');
            $table->smallInteger('square_mt');
            $table->boolean('show')->defaut(true);
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
        Schema::dropIfExists('apartments');
    }
}
