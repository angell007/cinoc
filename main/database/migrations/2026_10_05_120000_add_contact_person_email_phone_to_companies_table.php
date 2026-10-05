<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddContactPersonEmailPhoneToCompaniesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('companies', 'contact_email')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('contact_email', 100)->nullable()->after('contact_name');
            });
        }

        if (!Schema::hasColumn('companies', 'contact_phone')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('contact_phone', 30)->nullable()->after('contact_email');
            });
        }

        if (Schema::hasColumn('companies', 'contact_phone') && Schema::hasColumn('companies', 'phone')) {
            DB::table('companies')
                ->whereNull('contact_phone')
                ->whereNotNull('phone')
                ->where('phone', '!=', '')
                ->update(['contact_phone' => DB::raw('phone')]);
        }
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $columns = collect(['contact_email', 'contact_phone'])
                ->filter(function ($column) {
                    return Schema::hasColumn('companies', $column);
                })
                ->values()
                ->all();

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
}
