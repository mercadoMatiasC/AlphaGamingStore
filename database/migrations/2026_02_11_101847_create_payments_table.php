<?php

use App\Models\Order;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained(); //FOREIGN KEY
            $table->decimal('amount', 10, 2); 
            $table->string('method'); //MP, Transfer, Cash, Card
            $table->string('status'); //Pending, Completed, Cancelled, Refunded, Rejected
            $table->string('external_id')->unique();
            $table->timestamp('date_resolved')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
