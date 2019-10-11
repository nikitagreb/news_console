<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ParseCategory
 *
 * @package App\Entity
 * @property int $id
 * @property string $name Название
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ParseSource $source
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $category_id Категория
 * @property int $source_id Источник
 * @property string $link Ссылка на страницу категории
 * @property string $linkSelector Css селектор для ссылки
 * @property string $status Статус
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereLinkSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseCategory whereStatus($value)
 * @property-read \App\Models\ParseSource $category
 */
class ParseCategory extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_LOADED = 'loaded';

    /** @var string */
    protected $table = 'parse_category';

    public function source()
    {
        return $this->belongsTo(ParseSource::class);
    }

    public function category()
    {
        return $this->belongsTo(ParseSource::class);
    }

    public function setStatusLoaded(): void
    {
        $this->status = self::STATUS_LOADED;
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('source_id', '=', $this->getAttribute('source_id'))
            ->where('category_id', '=', $this->getAttribute('category_id'));
        return $query;
    }
}
