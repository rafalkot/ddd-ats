<?php

declare (strict_types=1);


namespace Ats\ApplicantTracking\Domain\Project;


use Ats\SharedKernel\Domain\UUID;

final class MemberId extends UUID
{

    public static function generate(): MemberId
    {
        return new self(self::random()->id());
    }
}
