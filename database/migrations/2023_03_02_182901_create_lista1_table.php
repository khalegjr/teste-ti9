<?php

use App\Models\Cliente;
use App\Models\Produto;
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
        Schema::create('lista1', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class, 'id');
            $table->foreignIdFor(Produto::class, 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista1');
    }
};
