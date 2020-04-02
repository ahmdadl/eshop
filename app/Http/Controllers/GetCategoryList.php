<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Database\Eloquent\Collection;

trait GetCategoryList
{
    protected function getList() : Collection
    {
        return Category::whereNull('category_id')->with(['subCat'])->get();
    }
}