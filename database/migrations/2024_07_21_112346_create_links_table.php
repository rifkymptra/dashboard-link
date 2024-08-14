<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained(
                table: 'sections',
                indexName: 'links_section_id'
            )->onDelete('cascade');
            $table->string('link_name');
            $table->string('url');
            $table->string('description_link');
            $table->boolean('vpn')->default(false);
            $table->foreignId('submitted_by')->constrained(
                table: 'users',
                indexName: 'links_submitted_by_index'
            )->onDelete('cascade')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained(
                table: 'users',
                indexName: 'links_approved_by_index'
            )->onDelete('set null');
            $table->string('status');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
};
