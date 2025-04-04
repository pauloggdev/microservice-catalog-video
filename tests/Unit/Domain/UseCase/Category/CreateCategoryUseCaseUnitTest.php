<?php

namespace Tests\Unit\Domain\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateCategoryUseCaseUnitTest extends TestCase
{

    public function testCreateNewCategory()
    {
        $categoryId          = (string) Uuid::random();
        $categoryName        = "New Category";
        $categoryDescription = "new category description";

        $categoryEntityMock         = Mockery::mock(Category::class, [$categoryId, $categoryName, $categoryDescription]);
        $categoryEntityMock->shouldReceive('id')->andReturn($categoryId);
        $categoryCreateInputDtoMock = new class($categoryName, $categoryDescription) extends CategoryCreateInputDto {};
        $categoryRepositoryMock     = Mockery::mock(CategoryRepositoryInterface::class);
        $categoryRepositoryMock->shouldReceive('insert')->andReturn($categoryEntityMock);
        $createCategoryUseCase = new CreateCategoryUseCase($categoryRepositoryMock);
        $output                = $createCategoryUseCase->execute($categoryCreateInputDtoMock);


        /**
         * Spy the createCategoryUseCase
         */

        $spy     = Mockery::mock(CategoryRepositoryInterface::class);
        $spy->shouldReceive('insert')->andReturn($categoryEntityMock);
        $createCategoryUseCase = new CreateCategoryUseCase($spy);
        $output                = $createCategoryUseCase->execute($categoryCreateInputDtoMock);
        $spy->shouldHaveReceived('insert');

        $this->assertEquals($categoryId, $output->id);
        $this->assertEquals($categoryName, $output->name);
        $this->assertEquals($categoryDescription, $output->description);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
