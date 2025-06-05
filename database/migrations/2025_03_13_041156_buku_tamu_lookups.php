<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buku_tamu_lookups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bkl_main', 30)->nullable(false);
            $table->string('bkl_sub', 30)->nullable(false);
            $table->string('bkl_kategori', 30)->nullable(false);
            $table->string('bkl_nilai', 500)->nullable(false);
            $table->string('bkl_catatan', 1000)->nullable();
            $table->char('bkl_status', 1)->nullable(false)->default('A');
            $table->string('created_by', 50)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_tamu_lookups');
    }
};