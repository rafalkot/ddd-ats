<?php

declare (strict_types=1);


namespace Ats\SharedKernel\Domain\Exception;


class InvalidUUIDException extends InvalidArgumentException
{
    public static function invalidFormat(string $id): InvalidUUIDException
    {
        return new self(sprintf('"%s" is not properly formatted UUID string', $id));
    }
}
