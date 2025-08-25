<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->integer('sort_order')->default(0);
            $table->boolean('is_main')->default(false);
        });

        $groups = DB::table('images')->orderBy('product_id')->orderBy('id')->get()->groupBy('product_id');
        foreach ($groups as $productId => $images) {
            $index = 0;
            foreach ($images as $image) {
                DB::table('images')->where('id', $image->id)->update([
                    'sort_order' => $index,
                    'is_main' => $index === 0,
                ]);
                $index++;
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['sort_order', 'is_main']);
        });
    }
};
