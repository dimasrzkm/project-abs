<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembukuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable(true)->constrained()->onDelete('cascade');
            $table->float('jumlah', 10, 3);
            $table->float('nominal_masuk', 10, 3)->nullable(true);
            $table->float('nominal_keluar', 10, 3)->nullable(true);
            $table->text('keterangan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembukuan');
    }
};
