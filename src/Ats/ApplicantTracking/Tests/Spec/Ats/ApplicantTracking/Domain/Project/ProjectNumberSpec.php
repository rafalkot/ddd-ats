<?php

namespace Spec\Ats\ApplicantTracking\Domain\Project;

use Ats\ApplicantTracking\Domain\Project\Exception\InvalidProjectNumberException;

use PhpSpec\ObjectBehavior;


class ProjectNumberSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('PROJECT-1');
    }

    function it_returns_number()
    {
        $this->number()->shouldReturn('PROJECT-1');
        $this->__toString()->shouldReturn('PROJECT-1');
    }

    function it_throws_exception_when_constructing_with_empty_string()
    {
        $this->shouldThrow(InvalidProjectNumberException::class)->during('__construct', ['']);
        $this->shouldThrow(InvalidProjectNumberException::class)->during('__construct', ['   ']);
    }
}
