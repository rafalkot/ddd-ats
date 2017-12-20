<?php

declare (strict_types=1);


namespace Ats\ApplicantTracking\Domain\Project;


use Ats\SharedKernel\Domain\UUID;

final class ProjectId extends UUID
{

    public static function generate(): ProjectId
    {
        return new self(self::random()->id());
    }
}
