
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->string('nik', 30)->nullable();
            $table->string('nomor_hp', 20)->nullable();
            $table->text('alamat_penghuni')->nullable();
            $table->string('status_penghuni')->default('Aktif');
        });
    }

    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'nomor_hp',
                'alamat_penghuni',
                'status_penghuni'
            ]);
        });
    }
};
