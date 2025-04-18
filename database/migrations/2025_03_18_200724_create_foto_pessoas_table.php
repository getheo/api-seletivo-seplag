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
        Schema::create('foto_pessoa', function (Blueprint $table) {                        
            $table->bigIncrements('fp_id');
            $table->foreignId('pes_id')->constrained('pessoa', 'pes_id');
            $table->dateTime('fp_data');
            $table->string('fp_bucket', 255);            
            $table->string('fp_hash', 255)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_pessoa');
    }
};
