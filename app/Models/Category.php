<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Entity
 * @property int $id
 * @property string $name Название
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParseCategory[] $parseCategories
 * @property-read int|null $parse_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParseLinkNews[] $parseLinkNews
 * @property-read int|null $parse_link_news_count
 * @property string $title Заголовок страницы
 * @property string $description Описание страницы
 * @property string $slug Псевдоним для ссылки
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereTitle($value)
 */
class Category extends Model
{
    /** @var string */
    protected $table = 'category';

    public function parseCategories()
    {
        return $this->hasMany(ParseCategory::class);
    }

    public function parseLinkNews()
    {
        return $this->hasMany(ParseLinkNews::class);
    }
}
