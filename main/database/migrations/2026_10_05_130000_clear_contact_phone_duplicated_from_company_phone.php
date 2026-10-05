<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearContactPhoneDuplicatedFromCompanyPhone extends Migration
{
    /**
     * La migración anterior copió phone → contact_phone; no debe confundirse con persona de contacto.
     */
    public function up()
    {
        if (!Schema::hasColumn('companies', 'contact_phone') || !Schema::hasColumn('companies', 'phone')) {
            return;
        }

        DB::table('companies')
            ->whereColumn('contact_phone', 'phone')
            ->update(['contact_phone' => null]);
    }

    public function down()
    {
        // No se restaura la copia automática.
    }
}
