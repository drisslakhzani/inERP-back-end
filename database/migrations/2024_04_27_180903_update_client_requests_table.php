<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('client_requests', function (Blueprint $table) {
            $table->json('selectedSolutions')->after('solutionType');
        });
    }

    public function down()
    {
        Schema::table('client_requests', function (Blueprint $table) {
            $table->dropColumn('selectedSolutions');
        });
    }
}
