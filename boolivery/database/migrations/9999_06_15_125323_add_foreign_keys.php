<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table  ->foreign('user_id', 'userRestaurant')
                    ->references('id')
                    ->on('users');
        });
        Schema::table('plates', function (Blueprint $table) {
            $table  ->foreign('restaurant_id', 'restaurantplate')
                    ->references('id')
                    ->on('restaurants');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table  ->foreign('restaurant_id', 'orderRestaurant')
                    ->references('id')
                    ->on('restaurants');
        });
        Schema::table('category_restaurant', function (Blueprint $table) {
            $table  ->foreign('category_id', 'restaurantcategory')
                    ->references('id')
                    ->on('categories');
                    // ->onDelete('cascade');
            $table  ->foreign('restaurant_id', 'categoryrestaurant')
                    ->references('id')
                    ->on('restaurants');
                    // ->onDelete('cascade');        
        });
        Schema::table('order_plate', function (Blueprint $table) {
            $table  ->foreign('order_id', 'plateorder')
                    ->references('id')
                    ->on('orders');
                    // ->onDelete('cascade');
            $table  ->foreign('plate_id', 'orderplate')
                    ->references('id')
                    ->on('plates');
                    // ->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints(); //per evitare di commentare le funzioni down ogni volta

        Schema::table('restaurants', function (Blueprint $table){
            $table -> dropForeign('userRestaurant');
        });
        Schema::table('plates', function (Blueprint $table){
            $table -> dropForeign('restaurantplate');
        });
        Schema::table('orders', function (Blueprint $table){
            $table -> dropForeign('orderRestaurant');
        });
        Schema::table('category_restaurant', function (Blueprint $table){
            $table -> dropForeign('restaurantcategory');
            $table -> dropForeign('categoryrestaurant');
        });
        Schema::table('order_plate', function (Blueprint $table){
            $table -> dropForeign('plateorder');
            $table -> dropForeign('orderplate');
        });
    }
}
