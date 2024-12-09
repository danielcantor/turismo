<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_subtitle_to_categories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubtitleToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('subtitle');
        });
    }
}