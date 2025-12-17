<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->string('menu_type')->default('principal')->after('slug');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('subcategory')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropColumn('menu_type');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('subcategory');
        });
    }
};
