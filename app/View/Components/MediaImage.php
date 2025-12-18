<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaImage extends Component
{
    public ?string $src;
    public string $alt;
    public string $class;

    public function __construct($media, string $alt = '', string $class = '', string $conversion = 'thumb')
    {
        $this->alt = $alt;
        $this->class = $class;
        $this->src = $this->getMediaUrl($media, $conversion);
    }

    protected function getMediaUrl($media, string $conversion): ?string
    {
        if (!$media) {
            return null;
        }

        // Se for uma instância de Media, usar diretamente
        if ($media instanceof Media) {
            try {
                $conversionPath = $media->getPath($conversion);
                if ($conversionPath && file_exists($conversionPath)) {
                    return '/storage/' . $media->id . '/conversions/' . basename($conversionPath);
                }
                return '/storage/' . $media->id . '/' . $media->file_name;
            } catch (\Exception $e) {
                return '/storage/' . $media->id . '/' . $media->file_name;
            }
        }

        // Se for um modelo com media, pegar o primeiro
        if (method_exists($media, 'getFirstMedia')) {
            $media = $media->getFirstMedia('photo') ?? $media->getFirstMedia('cover') ?? $media->getFirstMedia('image');
            if ($media) {
                return $this->getMediaUrl($media, $conversion);
            }
        }

        return null;
    }

    public function render()
    {
        if (!$this->src) {
            return '<div class="' . $this->class . ' bg-gray-200 flex items-center justify-center"><i data-lucide="image" class="w-6 h-6 text-gray-400"></i></div>';
        }

        return view('components.media-image');
    }
}


