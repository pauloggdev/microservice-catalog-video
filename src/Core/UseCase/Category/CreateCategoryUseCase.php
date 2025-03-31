<?php
namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;

class CreateCategoryUseCase
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function execute(CategoryCreateInputDto $input): CategoryCreateOutputDto
    {
        $category = new Category(name: $input->name, description: $input->description, isActive: $input->isActive);
        $output   = $this->categoryRepository->insert($category);
        return new CategoryCreateOutputDto(
            id: $output->id(),
            name: $output->name,
            description: $output->description,
            isActive: $output->isActive
        );
    }
}
