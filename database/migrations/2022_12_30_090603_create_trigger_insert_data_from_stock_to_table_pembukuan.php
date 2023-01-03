<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                CREATE
                    TRIGGER `project_abs`.`insert_data_to_pembukuan_from_stock` AFTER INSERT
                    ON `project_abs`.`stocks` 
                    FOR EACH ROW BEGIN
                    INSERT INTO pembukuan(jumlah, nominal_masuk, nominal_keluar, keterangan, tanggal) VALUES
                    (new.quantity, 0, new.price * new.quantity, CONCAT(new.name_stock, " telah dibeli"), DATE(NOW()));
                END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `insert_data_to_pembukuan_from_stock`');
    }
};
