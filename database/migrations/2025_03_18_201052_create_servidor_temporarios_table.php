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
        Schema::create('servidor_temporario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pes_id')->constrained('pessoa', 'pes_id');
            $table->dateTime('st_data_admissao');
            $table->dateTime('st_data_demissao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidor_temporarios');
    }
};
