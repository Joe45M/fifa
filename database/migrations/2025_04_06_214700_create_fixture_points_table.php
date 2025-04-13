<?php

use App\Enum\PointType;
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
        Schema::create('fixture_points', function (Blueprint $table) {
            $table->id();
            $table->integer('points')->index();
            $table->string('season')->index();
            $table->string('league_id')->index();
            $table->string('club_id')->index();
            $table->string('fixture_id')->index();
            $table->string('type')->default(PointType::League)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixture_points');
    }
};
