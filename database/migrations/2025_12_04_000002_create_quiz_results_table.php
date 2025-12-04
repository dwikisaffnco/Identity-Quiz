<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('q1')->nullable();
            $table->text('q2')->nullable();
            $table->string('q3')->nullable();
            $table->string('q4')->nullable();
            $table->string('q5')->nullable();
            $table->string('q6')->nullable();
            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);
            $table->integer('score_c')->default(0);
            $table->integer('score_d')->default(0);
            $table->integer('score_e')->default(0);
            $table->string('final_category')->nullable();
            $table->string('final_category_name')->nullable();
            $table->text('rolling_list')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
