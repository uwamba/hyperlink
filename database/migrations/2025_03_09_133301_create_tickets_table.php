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
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('description');
        $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
        $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('tickets');
}

};
