<?php
namespace Core\Domain\Entity;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
        $this->validate();
    }
    public function activate(): void
    {
        $this->isActive = true;
    }
    public function disable(): void{
        $this->isActive = false;
    }
    public function update(string $name, string $description = ''): void{
        $this->name = $name;
        $this->description = $description;
    }
    public function validate(): void{
       DomainValidation::notNull($this->name);
       DomainValidation::strMinLength($this->description);
    }
}
