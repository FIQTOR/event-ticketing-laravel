<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations to create the payments table.
     *
     * This method defines the structure of the payments table, which includes:
     * - id: Primary key for the table.
     * - user_id: Foreign key referencing the user making the payment.
     * - event_id: Foreign key referencing the event associated with the payment.
     * - payment_id: Unique identifier for the payment transaction.
     * - status: Current status of the payment, defaulting to 'unpaid'.
     * - total_price: Total amount for the payment.
     * - guest: Number of guests associated with the payment.
     * - layout: Layout type for the payment (e.g., seating arrangement).
     * - snap_token: Token for processing the payment through a payment gateway.
     * - timestamps: Automatically managed created_at and updated_at fields.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->text('payment_id');
            $table->string('status')->default('unpaid');
            $table->integer('total_price');
            $table->integer('guest');
            $table->string('layout');
            $table->string('snap_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations by dropping the payments table.
     *
     * This method is called when rolling back the migration, ensuring that
     * the payments table is removed from the database.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
