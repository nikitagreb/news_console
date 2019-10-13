<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParseSource
 *
 * @package App\Entity
 * @property int $id
 * @property string $name Название
 * @property string $site Сайт
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseSource whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParseCategory[] $parseCategories
 * @property-read int|null $parse_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParseLinkNews[] $parseLinkNews
 * @property-read int|null $parse_link_news_count
 * @property-read \App\Models\ParseNews $parseNews
 */
class ParseSource extends Model
{
    /** @var string */
    protected $table = 'parse_source';

    public function parseCategories()
    {
        return $this->hasMany(ParseCategory::class);
    }

    public function parseLinkNews()
    {
        return $this->hasMany(ParseLinkNews::class);
    }

    public function parseNews()
    {
        return $this->hasOne(ParseNews::class, 'source_id');
    }
}
