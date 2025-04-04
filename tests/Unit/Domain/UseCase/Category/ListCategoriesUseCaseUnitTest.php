<?php

namespace Tests\Unit\Domain\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListCategoriesEmpty(){

        $mockPagination = Mockery::mock(PaginationInterface::class);
        $mockPagination->shouldReceive('items')->andReturn([]);

        $mockRepository = Mockery::mock(CategoryRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $mockInputDto = Mockery::mock(ListCategoriesInputDto::class);
        $useCase = new ListCategoriesUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockInputDto);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);
        $this->assertCount(0, count($responseUseCase->items));
        

       
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}