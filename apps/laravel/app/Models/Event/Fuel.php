<?php

namespace App\Models\Event;

use App\Models\Transport\Transport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Заправки с транспорта
 * 
 * @property int    $id             заправка
 * @property int    $transport_id   транспорт
 * @property int    $mileage        пробег
 * @property float  $amount         количество литров
 * @property bool   $is_full        полный бак
 * @property float  $price          цена за литр
 * @property string $total          итоговая сумма
 * @property string $station_id     заправочная станция
 */
class Fuel extends Model
{
    protected $table = 'fuel';

    protected $fillable = [
        'transport_id',
        'mileage',
        'amount',
        'is_full',
        'price',
        'total',
        'station_id',
    ];

    public function transport(): BelongsTo 
    {
        return $this->belongsTo(Transport::class, 'transport_id');
    }
}
