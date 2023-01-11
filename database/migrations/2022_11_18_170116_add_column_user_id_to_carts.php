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
        Schema::table('carts', function (Blueprint $table) {
            //
            /**
             * 因為要建立的是關聯表的 ID
             * 所以不是使用 integer("user_id")
             * 而是要用foreignID() 這個方法來建立外來鍵
             * 再用 constrained() 這個方法來告訴程式 要綁定的另一張表是甚麼
             * 差別在於使用 foreignID() 會讓這個 column 帶有 foreignKey的性質
             * 意思是程式會去檢查綁定的另一張表中是否有對應的key 才會做後續的自訂動作
             */
            $table->foreignId("user_id")->constrained("users")->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            //
            /**
             * 由於在function up() 中建立的方式不是簡單的建立 column而已
             * 所以在 function down() 中來 reverse 的方式也不能單純使用 dropColumn() 這個方法
             * 錯誤使用 : $table->dropColumn("user_id");
             * 
             * 正確的使用方式則是 : dropConstrainedForeignId() 這個方法
             * 會解除原本指定的外來表的綁定後再 drop
             */
            $table->dropConstrainedForeignId("user_id");
        });
    }
};
