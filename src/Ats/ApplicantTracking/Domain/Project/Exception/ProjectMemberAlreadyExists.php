<?php

declare (strict_types=1);


namespace Ats\ApplicantTracking\Domain\Project\Exception;


use Ats\ApplicantTracking\Domain\Project\MemberId;
use Ats\ApplicantTracking\Domain\Project\ProjectId;
use Ats\SharedKernel\Domain\Exception\InvalidArgumentException;


class ProjectMemberAlreadyExists extends InvalidArgumentException
{
    public function __construct(MemberId $id, ProjectId $projectId)
    {
        parent::__construct(
            sprintf('Member "%s" is already assigned to project "%s"', $id, $projectId)
        );
    }
}
