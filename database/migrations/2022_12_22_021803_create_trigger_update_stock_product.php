<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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
        DB::unprepared('
                CREATE
                    TRIGGER `project_abs`.`update_stock_produk` BEFORE UPDATE
                    ON `project_abs`.`stocks` 
                    FOR EACH ROW BEGIN
                    INSERT INTO history_product(description, old_value, new_value, transaction_date) VALUES
                    (old.name_stock, old.amount, new.amount, DATE(NOW()));
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
        DB::unprepared('DROP TRIGGER `update_stock_produk`');
    }
};
