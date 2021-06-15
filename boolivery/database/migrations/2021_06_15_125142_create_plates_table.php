<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('restaurant_id') -> unsigned() -> index();
            $table->string('plate_name');
            $table->text('description');
            $table->string('image');
            $table->decimal('price', 8, 2);
            $table->boolean('visible') -> default(true);
            $table->boolean('popular') -> default(false);
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
        Schema::dropIfExists('plates');
    }
}
