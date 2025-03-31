<?php

use App\Enum\FixtureStatus;
use App\Enum\FixtureType;
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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->dateTime('kickoff_at');
            $table->bigInteger('home_club_id');
            $table->bigInteger('away_club_id');
            $table->string('type')->default(FixtureType::League);
            $table->bigInteger('league_id');
            $table->string('status')->default(FixtureStatus::Unplayed);
            $table->bigInteger('season');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
