<?php

declare (strict_types = 1);

namespace Ats\ApplicantTracking\Domain\Project;

use Webmozart\Assert\Assert;

final class ProjectVacancies
{
    const UNLIMITED = -1;

    /**
     * @var int
     */
    private $vacancies;

    public function __construct(int $vacancies)
    {
        $this->validate($vacancies);

        $this->vacancies = $vacancies;
    }

    public static function value(int $value): ProjectVacancies
    {
       return new self($value);
    }

    public static function unlimited(): ProjectVacancies
    {
        return new self(self::UNLIMITED);
    }

    private function validate(int $value): void
    {
        if ($value === self::UNLIMITED) {
            return;
        }

        Assert::greaterThan($value, 0);
    }

    public function vacancies():int
    {
        return $this->vacancies;
    }
}
