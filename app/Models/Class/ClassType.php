<?php

namespace App\Models\Class;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @method static create(string[] $array)
 * @method static truncate()
 * @method static insert(array[] $array)
 * @method static get()
 * @method static where(string $string, string $class_types)
 */
class ClassType extends Model
{
    public static function getCacheCategory()
    {
        return Cache::remember('class_types', 1, static fn() => self::all());
    }

    public static function getCache($id = null)
    {
        $all_type = self::getCacheCategory();
        return $id ? $all_type[$id] : $all_type;
    }

    public static function getLinkCategory($id)
    {
        $all_categories = self::getCacheCategory();
        foreach ($all_categories as $category) {
            if ($category->id === $id) {
                return $category->link;
            }
        }
        return null;
    }

    public static function getIdCategory($name)
    {
        $all_categories = self::getCacheCategory();
        foreach ($all_categories as $category) {
            if ($category->link === $name) {
                return $category->id;
            }
        }
        return null;
    }

    public static function whereIsset($column): array
    {
        $all_categories = self::getCacheCategory();
        $data = [];

        foreach ($all_categories as $category) {
            if ($category->$column) {
                $data[] = $category;
            }
        }
        return $data;
    }

    public static function getFind($column, $value)
    {
        $all_categories = self::getCacheCategory();

        foreach ($all_categories as $category) {
            if ($category->$column == $value) {
                return $category;
            }
        }
        return null;
    }
}
