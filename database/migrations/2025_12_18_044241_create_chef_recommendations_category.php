<?php

use App\Models\MenuCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Criar categoria "Indicações do Chef" se não existir
        MenuCategory::firstOrCreate(
            ['slug' => 'indicacoes-do-chef'],
            [
                'name' => 'Indicações do Chef',
                'slug' => 'indicacoes-do-chef',
                'description' => 'Seleções especiais do nosso chef executivo, pratos cuidadosamente escolhidos para proporcionar uma experiência gastronômica única',
                'menu_type' => 'principal',
                'sort_order' => 0, // Primeira categoria
                'is_active' => true,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover categoria se necessário
        MenuCategory::where('slug', 'indicacoes-do-chef')->delete();
    }
};
