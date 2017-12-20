<?php

declare (strict_types = 1);

namespace Ats\ApplicantTracking\Domain\Project;

use Webmozart\Assert\Assert;

final class ProjectState
{
    /**
     * @var string
     */
    private $state;

    public function __construct(string $state)
    {
        $this->validate($state);

        $this->state = $state;
    }

    public function state(): string
    {
        return $this->state;
    }

    private function validate(string $state)
    {
        Assert::stringNotEmpty(trim($state),'State cannot be empty');
    }

    public function __toString(): string
    {
        return $this->state;
    }
}
