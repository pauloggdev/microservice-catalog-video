<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{

    public function testAttributes(){
        $category = new Category(
            id:'',
            name: "New Category",
            description: "New Description",
            isActive: true
        );
        $this->assertEquals("New Category", $category->name);
        $this->assertEquals("New Description", $category->description);
        $this->assertTrue(true, $category->isActive);
    }

}