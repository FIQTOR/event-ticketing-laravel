<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations to create the events table.
     *
     * This method defines the structure of the events table, which includes:
     * - id: Primary key for the table.
     * - title: Title of the event.
     * - description: Detailed information about the event.
     * - address: Location where the event will take place.
     * - organizer: Name of the person or organization hosting the event.
     * - price: Cost of attending the event.
     * - event_date: Date when the event is scheduled to occur.
     * - layouts: Layout type for the event (e.g., seating arrangement).
     * - thumbnail: URL or path to the event's thumbnail image.
     * - isTopPopular: Indicates if the event is marked as a top popular event, defaulting to false.
     * - timestamps: Automatically managed created_at and updated_at fields.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('organizer');
            $table->integer('price');
            $table->date('event_date');
            $table->string('layouts');
            $table->text('thumbnail');
            $table->boolean('isTopPopular')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations by dropping the events table.
     *
     * This method is called when rolling back the migration, ensuring that
     * the events table is removed from the database.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
