<?php

declare (strict_types=1);


namespace Ats\ApplicantTracking\Domain\Project\Exception;


use Ats\SharedKernel\Domain\Exception\InvalidArgumentException;

class InvalidProjectNumberException extends InvalidArgumentException
{
    public static function emptyNumber(): InvalidProjectNumberException
    {
        return new self('Project number cannot be empty');
    }
}
