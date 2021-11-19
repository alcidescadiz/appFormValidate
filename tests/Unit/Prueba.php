<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class Prueba extends TestCase
{
    public function test_example()
    {
        $Category = new Category();
        $this->assertInstanceOf(Collection::class, $Category->products);
    }
}
