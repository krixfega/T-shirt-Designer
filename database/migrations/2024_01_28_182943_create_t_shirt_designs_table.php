<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('t_shirt_designs', function (Blueprint $table) {
        $table->id();
        $table->string('design'); // Ensure this line is present
        $table->string('image_path');
        $table->text('generated_code');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_shirt_designs');
    }
};
