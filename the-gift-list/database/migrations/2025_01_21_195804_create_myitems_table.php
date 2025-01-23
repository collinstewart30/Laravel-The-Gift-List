<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('myitems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('item_url');
            $table->boolean('is_completed')->default(false);
            $table->unsignedInteger('list_id')->nullable();
            $table->timestamps();
        });
        Schema::table('myitems', function (Blueprint $table) {
            $table->foreign('list_id')->references('id')->on('mylists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myitems');
    }
};
