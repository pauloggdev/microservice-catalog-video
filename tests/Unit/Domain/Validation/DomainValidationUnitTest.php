<?php
namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        $this->expectException(EntityValidationException::class);
        $value = '';
        DomainValidation::notNull($value);
    }
    public function testNotNullCustomMessageException()
    {
        $this->expectExceptionMessage("custom message error");
        $value = '';
        DomainValidation::notNull($value, "custom message error");
    }
    public function testStrMaxLength()
    {
        $this->expectException(EntityValidationException::class);
        $value = 'Teste';
        DomainValidation::strMaxLength($value, 3, "Custom message error");
    }
    public function testStrMinLength()
    {
        $this->expectException(EntityValidationException::class);
        $value = 'a';
        DomainValidation::strMinLength($value, 8, "Custom message error");
    }
}
