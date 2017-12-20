<?php

declare (strict_types = 1);

namespace Ats\ApplicantTracking\Domain\Project;

use Webmozart\Assert\Assert;

final class RoleId
{
    /**
     * @var string
     */
    private $role;

    public function __construct(string $role)
    {
        $this->validate($role);

        $this->role = $role;
    }

    public function role(): string
    {
        return $this->role;
    }

    private function validate(string $role)
    {
        Assert::stringNotEmpty(trim($role),'Role name cannot be empty');
    }

    public function __toString(): string
    {
        return $this->role;
    }
}
