<?php

declare(strict_types=1);

namespace Tests\Setup;

use App\Category;
use App\Product;

class CategoryFactory
{
    private $sub_count = 1;
    private $product_count = 1;


    public function wSub(int $count = 1): self
    {
        $this->sub_count = $count;
        return $this;
    }

    public function wPro(int $count = 1): self
    {
        $this->product_count = $count;
        return $this;
    }

    public function create(): array
    {
        return $this->set();
    }

    public function make(
        bool $is_sub = false
    ): array {
        return $is_sub ? $this->set(null, 'make') : $this->set(null, null, 'make');
    }

    public function raw(
        bool $is_sub = false
    ): array {
        return $is_sub ? $this->set(null, 'raw') : $this->set(null, null, 'raw');
    }

    private function set(
        ?string $cat_method = 'create',
        ?string $sub_method = 'raw',
        string $product_method = 'raw'
    ): array {
        $sc = $p = [];

        /** @var \App\Category $c */
        $c = factory(Category::class)->{$cat_method}();

        if ($this->sub_count >= 1) {
            /** @var \App\Category $sc */
            $sc = $c->subCat()->createMany(
                factory(Category::class, $this->sub_count)->{$sub_method}()
            );

            $scc = $sc;
            if ($this->sub_count === 1) $sc = $sc[0]->first();

            if ($this->product_count >= 1) {
                /** @var \App\Product $p */
                $p = $scc[0]->first()->products()->createMany(
                    factory(Product::class, $this->product_count)->{$product_method}([
                        'category_slug' => $sc->slug
                    ])
                );

                if ($this->product_count === 1) $p = $p[0]->first();
            }
        } else {
            /** @var \App\Category $sc */
            $sc = factory(Category::class)->{$sub_method}([
                'category_id' => $c->id
            ]);
        }

        
        return [$c, $sc, $p];
    }
}
