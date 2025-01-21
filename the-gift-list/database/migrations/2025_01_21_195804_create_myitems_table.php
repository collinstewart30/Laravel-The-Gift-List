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
            $table->boolean('is_completed')->default(false);
            $table->foreignId('list_id')->references('id')->on('mylists');
            $table->timestamps();
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
