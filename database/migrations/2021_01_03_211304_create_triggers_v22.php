<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggersV22 extends Migration
{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        DB::unprepared('
//        CREATE TRIGGER tr__Update_Username AFTER Update ON `users` FOR EACH ROW
//            Begin
//                IF NEW.ID NOT IN
//                    (SELECT JSON_EXTRACT(data,\'$.userId\') from notifications
//                    WHERE
//                        JSON_EXTRACT(data,\'$.username\') = NEW.username
//                    )THEN
//                        UPDATE notifications
//                            SET
//                           `data` = JSON_SET(data,\'$.username\',NEW.username)
//                           WHERE
//                           JSON_EXTRACT(data,\'$.userId\') = NEW.ID;
//                   END IF;
//            END
//        ');
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        DB::unprepared('DROP TRIGGER IF EXISTS `tr__Update_Username`');
//    }
}
