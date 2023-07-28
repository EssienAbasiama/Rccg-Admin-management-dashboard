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
        Schema::create('newcomers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('surname');
            $table->string('othername')->nullable();
            $table->string('gender');
            $table->string('phonenumber');
            $table->string('marital_status');
            $table->string('age_bracket');
            $table->string('occupation');
            $table->string('nationality');
            $table->boolean('visitable')->default(false);
            $table->string('state_of_residence');
            $table->string('nearest_bus_stop');
            $table->string('house_address');
            $table->text('special_message')->nullable();
            $table->text('prayer_request')->nullable();
            $table->string('email')->unique();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newcomers');
    }
};
