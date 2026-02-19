<?php

namespace App\Models\Event;

use App\Models\Event\Event;
use App\Models\Event\Resource;
use Database\Factories\DetailFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Собития с транспортом
 * 
 * @property int    $id             подсобытие
 * @property int    $event_id       транспорт
 * @property int    $name           тип события
 * @property float  $work           расходы на работу
 * @property float  $resource       расходы на ресурсы
 * @property float  $total          сумма расходов
 * @property string $description    описание
 */
class Detail extends Model
{
    use HasFactory;
    
    protected $table = 'event_details';

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'name',
        'work',
        'resource',
        'total',
        'description',
    ];

    public function event(): BelongsTo 
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Undocumented function
     *
     * @return HasMany
     */
    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class, 'details_id');
    }

    protected static function newFactory(): DetailFactory
    {
        return DetailFactory::new();
    }
}
