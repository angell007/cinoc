<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployerRegistrationFieldsToCompaniesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('companies', 'person_type')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('person_type', 20)->nullable();
            });
        }

        if (!Schema::hasColumn('companies', 'contact_name')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('contact_name', 150)->nullable();
            });
        }

        if (!Schema::hasColumn('companies', 'ceo_email')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('ceo_email', 100)->nullable();
            });
        }
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $columns = collect(['person_type', 'contact_name', 'ceo_email'])
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
