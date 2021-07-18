<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicationsTable extends Migration
{
    public function up()
    {
        Schema::create('indications', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('indications');
    }
}
