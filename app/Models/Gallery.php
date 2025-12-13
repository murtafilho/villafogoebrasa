<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'category',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public const CATEGORY_AMBIENTE = 'ambiente';
    public const CATEGORY_PRATOS = 'pratos';
    public const CATEGORY_EVENTOS = 'eventos';
    public const CATEGORY_EQUIPE = 'equipe';

    public static function categories(): array
    {
        return [
            self::CATEGORY_AMBIENTE => 'Ambiente',
            self::CATEGORY_PRATOS => 'Pratos',
            self::CATEGORY_EVENTOS => 'Eventos',
            self::CATEGORY_EQUIPE => 'Equipe',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->sharpen(10);

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(800)
            ->sharpen(10);
    }
}
