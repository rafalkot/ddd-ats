<?php

namespace Spec\Ats\ApplicantTracking\Domain\Project;

use Ats\ApplicantTracking\Domain\Project\ProjectVacancies;
use PhpSpec\ObjectBehavior;


class ProjectVacanciesSpec extends ObjectBehavior
{
    function it_can_be_constructed_with_unsigned_int()
    {
        $this->beConstructedWith(1);

        $this->vacancies()->shouldReturn(1);
    }

    function it_cant_be_constructed_with_zero()
    {
        $this->shouldThrow(\InvalidArgumentException::class)
            ->during('__construct', [0]);
    }

    function it_can_be_constructed_with_infinite_value()
    {
        $this->beConstructedWith(ProjectVacancies::UNLIMITED);

        $this->vacancies()->shouldReturn(ProjectVacancies::UNLIMITED);
    }

    function it_can_be_constructed_statically_through_unlimited()
    {
        $this->beConstructedThrough('unlimited');
        $this->vacancies()->shouldReturn(ProjectVacancies::UNLIMITED);

    }

    function it_can_be_constructed_statically_through_value()
    {
        $this->beConstructedThrough('value', [5]);
        $this->vacancies()->shouldReturn(5);
    }
}
