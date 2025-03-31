<?php

use App\Enum\ContractStatus;
use App\Enum\ContractType;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('club_id');
            $table->bigInteger('season');
            $table->bigInteger('length');
            $table->bigInteger('games_remaining');
            $table->string('status')->default(ContractStatus::Pending);
            $table->string('type')->default(ContractType::Player);      // Player, manager, coManager
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
