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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->index()->nullable();
            $table->string('kode', 15)->unique();
            $table->string('nama_brg', 50);
            $table->integer('jumlah');
            $table->float('satuan');
            $table->date('tgl_beli')->nullable();
            $table->date('tgl_produksi')->nullable();
            $table->date('exp')->nullable();
            $table->float('biaya_agkt');
            $table->float('ppn')->nullable();
            $table->float('total');
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
        Schema::dropIfExists('pembelians');
    }
};
