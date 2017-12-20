<?php

declare (strict_types=1);


namespace Ats\ApplicantTracking\Domain\Project\Exception;


use Ats\ApplicantTracking\Domain\Project\ProjectState;
use Ats\SharedKernel\Domain\Exception\Exception;

class InvalidProjectStateTransitionException extends Exception
{
    public static function invalidTransition(ProjectState $fromState, ProjectState $toState)
    {
        return new self(sprintf('Can\'t do transition from %s to %s', $fromState, $toState));
    }
}
