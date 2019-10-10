<?php

namespace App\Entity;

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
 * @property-read \App\Entity\ParseSource $source
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $category_id Категория
 * @property int $source_id Источник
 * @property string $link Ссылка на страницу категории
 * @property string $linkSelector Css селектор для ссылки
 * @property string $status Статус
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereLinkSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseCategory whereStatus($value)
 * @property-read \App\Entity\ParseSource $category
 */
class ParseCategory extends Model
{
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

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('source_id', '=', $this->getAttribute('source_id'))
            ->where('category_id', '=', $this->getAttribute('category_id'));
        return $query;
    }
}
