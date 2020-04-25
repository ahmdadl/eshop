<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Arr;
use Cache;

trait GetCategoryList
{
    protected function getList()
    {
        return Category::whereNull('category_id')->with(['subCat'])->get();
    }

    protected function getImgArr(): array
    {
        $arr = range(1, 14);
        return [
            Arr::random($arr) . '.jpg', Arr::random($arr) . '.jpg', Arr::random($arr) . '.jpg'
        ];
    }
}
