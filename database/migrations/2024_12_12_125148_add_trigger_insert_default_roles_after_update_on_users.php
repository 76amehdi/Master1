<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the trigger for updating usertype to 1
        DB::unprepared('
            CREATE TRIGGER insert_default_roles_after_update
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF NEW.usertype = 1 AND OLD.usertype != 1 THEN
                    INSERT INTO user_roles (user_id, manage_categories, manage_products, manage_users, manage_orders, admin)
                    VALUES (NEW.id, false, false, false, false, false);
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger if rolling back the migration
        DB::unprepared('DROP TRIGGER IF EXISTS insert_default_roles_after_update');
    }
};
