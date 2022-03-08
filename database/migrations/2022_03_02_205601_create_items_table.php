<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Shelf;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->tinyText('name');
            $table->integer('amount');
            $table->tinyInteger('column_start');
            $table->tinyInteger('column_end');
            $table->tinyInteger('row_start');
            $table->tinyInteger('row_end');
            $table->foreignIdFor(Shelf::class);
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
        Schema::dropIfExists('items');
    }
}
