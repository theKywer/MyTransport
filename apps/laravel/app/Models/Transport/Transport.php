<?php

namespace App\Models\Transport;

use App\Enum\TransportType;
use App\Models\User;
use App\Models\Event\Fuel;
use App\Models\Event\Event;
use Database\Factories\TransportFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Транспорт
 * 
 * @property int        $id
 * @property int        $user_id                пользователь
 * @property int        $type_id                тип транспорта
 * @property string     $name                   пользовательское имя транспорта
 * @property string     $vin                    идентификатор транспорта
 * @property int        $year                   год выпуска
 * @property string     $brand                  бренд транспорта
 * @property string     $model                  модель транспорта
 * @property int        $mileage                пробег
 * @property decimal    $average_consumption    средний расход
 */
class Transport extends Model
{
    use HasFactory;

    protected $table = 'transport';

    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'vin',
        'year',
        'brand',
        'model',
        'mileage',
        'average_consumption',
    ];

    protected $appends = ['type_label'];

    public function getTypeLabelAttribute(): string
    {
        return $this->type_id->label();
    }

    protected $casts = [
        'year' => 'integer',
        'type_id' => TransportType::class,
    ];

    public function scopeOfType($query, TransportType $type)
    {
        return $query->where('type_id', $type);
    }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'transport_id');
    }

    public function fuels(): HasMany
    {
        return $this->hasMany(Fuel::class, 'transport_id');
    }

    protected static function newFactory(): TransportFactory
    {
        return TransportFactory::new();
    }
}
