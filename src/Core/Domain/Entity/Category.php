<?php
namespace Core\Domain\Entity;

use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected Uuid | string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->validate();
    }
    public function activate(): void
    {
        $this->isActive = true;
    }
    public function disable(): void
    {
        $this->isActive = false;
    }
    public function update(string $name, string $description = ''): void
    {
        $this->name        = $name;
        $this->description = $description;
    }
    public function validate(): void
    {
        DomainValidation::notNull($this->name);
        DomainValidation::strMinLength($this->description);
    }
}
