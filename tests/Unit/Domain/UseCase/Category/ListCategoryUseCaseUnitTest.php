<?php

namespace Tests\Unit\Domain\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\CategoryOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListCategoryUseCaseUnitTest extends TestCase
{

    public function testGetById(){

        $categoryId          = (string) Uuid::random();

        $categoryEntityMock = Mockery::mock(Category::class, [
            $categoryId,
            'New category',
            'New category description',
        ]);

        $categoryRepositoryMock = Mockery::mock(CategoryRepositoryInterface::class);
        $categoryRepositoryMock->shouldReceive('findById')
        ->with($categoryId)
        ->andReturn($categoryEntityMock);


        $mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [$categoryId]);

        $useCase = new ListCategoryUseCase($categoryRepositoryMock);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $response);
        $this->assertEquals($categoryId, $response->id);
        $this->assertEquals("New category", $response->name);
        $this->assertEquals("New category description", $response->description);

        /**
         * Spies
         */
        $categoryRepositorySpy = Mockery::spy(CategoryRepositoryInterface::class);
        $categoryRepositorySpy->shouldReceive('findById')
        ->with($categoryId)
        ->andReturn($categoryEntityMock);

        $useCase = new ListCategoryUseCase($categoryRepositorySpy);
        $response = $useCase->execute($mockInputDto);
        $categoryRepositorySpy->shouldHaveReceived('findById');
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}