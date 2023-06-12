<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('to_do_lists', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('admin_id');

            $table->index('admin_id', 'list_admin_idx');
            $table->foreign('admin_id', 'list_admin_fk')
                ->on('users')
                ->references('id')->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('to_do_lists');
    }
};
