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
        Schema::create('lotacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lot_id')->unique();
            $table->foreignId('pes_id')->constrained('pessoa', 'pes_id');
            $table->foreignId('unid_id')->constrained('unidade', 'unid_id');
            $table->date('lot_data_lotacao');
            $table->date('lot_data_remocao')->nullable();
            $table->string('lot_portaria', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotacao');
    }
};
