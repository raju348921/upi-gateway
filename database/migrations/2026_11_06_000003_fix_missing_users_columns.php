
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = [
            'business_name' => fn ($table) => $table->string('business_name')->nullable(),
            'phone' => fn ($table) => $table->string('phone')->nullable(),
            'role' => fn ($table) => $table->string('role')->default('merchant'),
            'is_active' => fn ($table) => $table->boolean('is_active')->default(true),
            'rotation_mode' => fn ($table) => $table->string('rotation_mode')->default('random'),
        ];

        foreach ($columns as $column => $definition) {
            if (!Schema::hasColumn('users', $column)) {
                Schema::table('users', function (Blueprint $table) use ($definition) {
                    $definition($table);
                });
            }
        }
    }

    public function down(): void
    {
        // Existing user data and columns are preserved.
    }
};
