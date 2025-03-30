<?php
namespace Core\Domain\ValueObject;

class Uuid
{

    public function __construct(protected string $value)
    {
        $this->ensureIsValid($value);

    }
    public static function random(): self
    {
        $data    = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Define a versão 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Define a variante RFC 4122
        $uuid    = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        return new self($uuid);

    }
    public function __toString()
    {
        return $this->value;
    }
    private function ensureIsValid($id)
    {
        return true;
        if (empty($id)) {
            throw new \InvalidArgumentException("UUID should not be empty");
        }
    }

}
