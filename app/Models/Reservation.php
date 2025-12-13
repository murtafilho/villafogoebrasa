<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'guests',
        'occasion',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'guests' => 'integer',
        ];
    }

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_COMPLETED = 'completed';

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pendente',
            self::STATUS_CONFIRMED => 'Confirmada',
            self::STATUS_CANCELLED => 'Cancelada',
            self::STATUS_COMPLETED => 'Concluída',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }
}
