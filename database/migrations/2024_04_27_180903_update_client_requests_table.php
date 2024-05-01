<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientRequestsTable extends Migration
{
    public function up()
    {
        // Check if the 'selectedSolutions' column does not exist before adding it
        if (!Schema::hasColumn('client_requests', 'selectedSolutions')) {
            Schema::table('client_requests', function (Blueprint $table) {
                $table->json('selectedSolutions')->after('solutionType');
            });
        }
    }

    public function down()
    {
        // Drop the 'selectedSolutions' column if it exists
        Schema::table('client_requests', function (Blueprint $table) {
            $table->dropColumn('selectedSolutions');
        });
    }
}

