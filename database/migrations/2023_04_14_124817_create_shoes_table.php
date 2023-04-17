<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 50);
            $table->string('model', 100);
            $table->string('material', 100)->nullable();
            $table->string('image')->nullable();
            $table->string('color', 20);
            $table->decimal('price', 6, 2);
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('shoes');
    }
};
