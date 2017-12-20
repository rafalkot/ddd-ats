<?php

declare (strict_types=1);


namespace Ats\ApplicantTracking\Domain\Project;


interface ProjectStateTransitionValidator
{
    public function validateTransition(ProjectState $from, ProjectState $to): bool;
}
