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
        Schema::table('wrestlers', function (Blueprint $table) {
            $table->string('image')->nullable()->after('name');
            $table->string('hometown')->nullable()->after('image');
            $table->string('height')->nullable()->after('hometown');
            $table->string('weight')->nullable()->after('height');
            $table->text('bio')->nullable()->after('weight');
        });
    }

    public function down(): void
    {
        Schema::table('wrestlers', function (Blueprint $table) {
            $table->dropColumn(['image', 'hometown', 'height', 'weight', 'bio']);
        });
    }
};
