<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the storage_buildings table
        Schema::create('storage_buildings', function (Blueprint $table) {
            $table->id();  // Primary key for the storage_buildings table
            $table->string('name');  // Name of the storage building
            $table->integer('capacity');  // Capacity of the storage building
            $table->string('location');  // Location of the storage building
            $table->timestamps();  // Timestamps for created_at and updated_at
        });

        // Create the storages table
        Schema::create('storages', function (Blueprint $table) {
            $table->id();  // Primary key for the storages table
            $table->string('name');  // Name of the storage item
            $table->text('description')->nullable();  // Description of the storage item
            $table->integer('quantity')->default(0);  // Quantity of the storage item
            $table->unsignedBigInteger('storage_building_id');  // Foreign key to storage_buildings
            $table->timestamps();  // Timestamps for created_at and updated_at

            // Define foreign key constraint
            $table->foreign('storage_building_id')
                  ->references('id')  // Column that this foreign key references
                  ->on('storage_buildings')  // The table this foreign key references
                  ->onDelete('cascade');  // Cascade delete on storage_building deletion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the tables in reverse order of creation to avoid foreign key constraint errors
        Schema::dropIfExists('storages');
        Schema::dropIfExists('storage_buildings');
    }
};
