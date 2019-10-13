<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\News
 *
 * @property int $id
 * @property int $category_id Категория
 * @property int $source_id Источник
 * @property string $link Ссылка на новость
 * @property string $title Заголовок
 * @property string $description Описание
 * @property string $image Изображение
 * @property string $text Текст новости
 * @property string $status Статус
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\ParseSource $source
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    /** @var string */
    protected $table = 'news';

    public function source()
    {
        return $this->belongsTo(ParseSource::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
