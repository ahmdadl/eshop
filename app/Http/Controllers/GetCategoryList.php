<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Arr;
use Cache;

trait GetCategoryList
{
    protected function getList()
    {
        return Cache::rememberForever('cats', function() {
            return Category::whereNull('category_id')->with(['subCat'])->get();
        });
    }

    protected function getImgArr(): array
    {
        $arr = range(1, 5);
        return [
            Arr::random($arr) . '.png', Arr::random($arr) . '.png', Arr::random($arr) . '.png'
        ];
    }
}