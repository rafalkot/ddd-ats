<?php

declare (strict_types=1);

namespace Ats\SharedKernel\Domain;

use Ats\SharedKernel\Domain\Exception\InvalidUUIDException;

class UUID
{
    /**
     * @var string
     */
    protected $id;

    /**
     * UUID constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->validate($uuid);

        $this->id = $uuid;
    }

    /**
     * @return static
     */
    protected static function random(): UUID
    {
        return new static(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * @param UUID $id
     * @return bool
     */
    public function equals(UUID $id): bool
    {
        return $this->id === $id->id;
    }

    /**
     * @throws InvalidUUIDException
     * @param string $uuid
     */
    private function validate(string $uuid)
    {
        if (!\Ramsey\Uuid\Uuid::isValid($uuid)) {
            throw new InvalidUUIDException();
        }
    }
}
