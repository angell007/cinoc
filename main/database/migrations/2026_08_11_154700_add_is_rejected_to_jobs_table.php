<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRejectedToJobsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('jobs', 'is_rejected')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->boolean('is_rejected')->default(0)->after('is_active');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('jobs', 'is_rejected')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->dropColumn('is_rejected');
            });
        }
    }
}
