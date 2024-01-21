<?php

use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableProductCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            //relacje 
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // ->onDelete('cascade'); automatycznie usuwa odpowiednie 
            // rekordy z tabeli łączącej, gdy produkt lub kategoria zostanie usunięta
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_category', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['category_id']);

            $table->dropIfExists('product_category');
        });
    }
}
