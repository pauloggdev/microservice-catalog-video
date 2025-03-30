<?php
namespace Core\Domain\Entity;

use Mockery\Exception;

trait MethodsMagicsTrait
{
    public function __get($property)
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }
        $className = get_class($this);
        throw new Exception("Property {$property} not found in class {$className}");
    }
    public function id(): string
    {
        return (string) $this->id;
    }
}
