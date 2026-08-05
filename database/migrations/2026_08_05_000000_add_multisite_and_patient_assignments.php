<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('assigned_exams')->nullable()->after('place');
        });

        foreach (['bournouts', 'eysencks', 'barons', 'claustrofobies', 'audits', 'acrofobies', 'epworths'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->foreignId('place_id')->nullable()->after('id')->constrained('places')->nullOnDelete();
                $table->foreignId('patient_id')->nullable()->after('place_id')->constrained('users')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        foreach (['bournouts', 'eysencks', 'barons', 'claustrofobies', 'audits', 'acrofobies', 'epworths'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropConstrainedForeignId('patient_id');
                $table->dropConstrainedForeignId('place_id');
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('assigned_exams');
        });
    }
};
