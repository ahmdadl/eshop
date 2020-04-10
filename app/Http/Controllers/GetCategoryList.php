<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Arr;
use Illuminate\Database\Eloquent\Collection;

trait GetCategoryList
{
    protected function getList() : Collection
    {
        return Category::whereNull('category_id')->with(['subCat'])->get();
    }

    protected function getImgArr(): array
    {
        $arr = range(1, 5);
        return [
            Arr::random($arr) . '.png', Arr::random($arr) . '.png', Arr::random($arr) . '.png'
        ];
    }
}