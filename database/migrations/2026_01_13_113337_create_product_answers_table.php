<?php

use App\Models\ProductQuestion;
use App\Models\User;
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
        Schema::create('product_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained(); //FOREIGN KEY
            $table->foreignIdFor(ProductQuestion::class)->constrained(); //FOREIGN KEY
            $table->string('answer');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_answers');
    }
};
