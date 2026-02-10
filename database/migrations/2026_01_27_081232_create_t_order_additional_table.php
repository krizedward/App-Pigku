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
        Schema::create('t_order_additional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('t_order')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('order_detail_id')
                ->nullable()
                ->constrained('t_order_detail')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('type_additional')->nullable();
            $table->integer('value_additional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_order_additional');
    }
};
