<?php

declare (strict_types = 1);

namespace Ats\ApplicantTracking\Domain\Project;

use Ats\ApplicantTracking\Domain\Project\Exception\InvalidProjectNumberException;

final class ProjectNumber
{
    /**
     * @var string
     */
    private $number;


    public function __construct(string $number)
    {
        $this->validate($number);

        $this->number = $number;
    }

    public function number():string
    {
        return $this->number;
    }

    public function __toString():string
    {
        return $this->number;
    }

    private function validate(string $number)
    {
        if (empty(trim($number))) {
            throw InvalidProjectNumberException::emptyNumber();
        }
    }
}
