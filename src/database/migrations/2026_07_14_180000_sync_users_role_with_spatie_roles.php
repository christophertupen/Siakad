<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (User::all() as $user) {
            if (filled($user->role)) {
                $spatieRole = match ($user->role) {
                    'admin' => 'super_admin',
                    default => $user->role,
                };

                if (class_exists(\Spatie\Permission\Models\Role::class)) {
                    // Ensure the role exists first before syncing
                    \Spatie\Permission\Models\Role::firstOrCreate(['name' => $spatieRole, 'guard_name' => 'web']);
                }

                $user->syncRoles([$spatieRole]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
