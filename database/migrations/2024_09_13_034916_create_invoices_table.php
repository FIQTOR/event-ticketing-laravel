<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations to create the invoices table.
     *
     * This method defines the structure of the invoices table, which includes:
     * - id: Primary key for the table.
     * - user_id: Foreign key referencing the user associated with the invoice.
     * - event_id: Foreign key referencing the event related to the invoice.
     * - payment_id: Foreign key referencing the payment associated with the invoice.
     * - invoice_number: Unique identifier for the invoice, defaulting to 0.
     * - ticket_status: Current status of the ticket, defaulting to 'valid'.
     * - timestamps: Automatically managed created_at and updated_at fields.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('payment_id');
            $table->bigInteger('invoice_number')->default(0);
            $table->string('ticket_status')->default('valid');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations by dropping the invoices table.
     *
     * This method is called when rolling back the migration, ensuring that
     * the invoices table is removed from the database.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
