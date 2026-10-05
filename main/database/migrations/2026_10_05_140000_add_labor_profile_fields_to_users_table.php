<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaborProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'job_interest_occupation')) {
                $table->string('job_interest_occupation', 255)->nullable()->after('current_job_situation');
            }
            if (!Schema::hasColumn('users', 'work_modality')) {
                $table->string('work_modality', 100)->nullable()->after('job_interest_occupation');
            }
            if (!Schema::hasColumn('users', 'work_schedule_type')) {
                $table->string('work_schedule_type', 100)->nullable()->after('work_modality');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['job_interest_occupation', 'work_modality', 'work_schedule_type'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
