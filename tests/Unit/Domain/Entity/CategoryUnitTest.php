<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\ValueObject\Uuid;

class CategoryUnitTest extends TestCase
{

    public function testAttributes(){
        $category = new Category(
            name: "New Category",
            description: "New Description",
            isActive: true
        );
        $this->assertNotEmpty($category->id());
        $this->assertNotEmpty($category->createdAt());
        $this->assertEquals("New Category", $category->name);
        $this->assertEquals("New Description", $category->description);
        $this->assertTrue(true, $category->isActive);
    }
    public function testActived(){

        $category = new Category(
            name: "New Category",
            description: "New Description",
            isActive: false
        );
        $this->assertFalse($category->isActive, false);
        $category->activate();
        $this->assertTrue($category->isActive, true);
    }
    public function testdisabled(){
        $category = new Category(
            name: "New Category",
            description: "New Description",
            isActive: true
        );
        $this->assertTrue($category->isActive, true);
        $category->disable();
        $this->assertFalse($category->isActive, false);
    }
    public function testUpdate(){
        $uuid = (string) Uuid::random();
        $category = new Category(
            id: $uuid,
            name: "New Category",
            description: "New Description",
            isActive: true,
            createdAt:'2025-01-01 10:00:00'
        );
        $category->update(name: "New Category 01", description: "New Description 01");
        $this->assertEquals("New Category 01", $category->name);
        $this->assertEquals("New Description 01", $category->description);
        
    }
    public function testExceptionName(){
        $this->expectException(EntityValidationException::class);
        $category = new Category(
            name: "",
            description: "New Description",
            isActive: true
        );
        $category->validate();
    }
    public function testExceptionDescription(){
        $this->expectException(EntityValidationException::class);
        $category = new Category(
            name: "New Category",
            description: "ad",
            isActive: true
        );
        $category->validate();
    }

}