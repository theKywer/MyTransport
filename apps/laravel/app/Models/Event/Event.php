<?php

namespace App\Models\Event;

use App\Enum\EventType;
use App\Models\Event\Detail;
use App\Models\Transport\Transport;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Собития с транспортом
 * 
 * @property int    $id             событие
 * @property int    $transport_id   транспорт
 * @property int    $type_id        тип события
 * @property int    $mileage        пробег
 * @property float  $work           расходы на работу
 * @property float  $resource       расходы на ресурсы
 * @property float  $total          сумма расходов
 * @property string $location       место где произошло событие
 * @property string $description    описание
 */
class Event extends Model
{
    use HasFactory;
    
    protected $table = 'event';

    protected $fillable = [
        'transport_id',
        'type_id',
        'mileage',
        'work',
        'resource',
        'total',
        'location',
        'description',
    ];

    protected $appends = ['type_label'];

    public function getTypeLabelAttribute(): string
    {
        return $this->type_id->label();
    }

    protected $casts = [
        'type_id' => EventType::class,
    ];

    public function scopeOfType($query, EventType $type)
    {
        return $query->where('type_id', $type);
    }

    public function transport(): BelongsTo 
    {
        return $this->belongsTo(Transport::class, 'transport_id');
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(Detail::class, 'event_id');
    }

    protected static function newFactory(): EventFactory
    {
        return EventFactory::new();
    }
}
