<?php

namespace Spec\Ats\ApplicantTracking\Domain\Project;

use PhpSpec\ObjectBehavior;

class ProjectStateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('ACTIVE');
    }

    function it_returns_state()
    {
        $this->state()->shouldReturn('ACTIVE');
        $this->__toString()->shouldReturn('ACTIVE');
    }

    function it_throws_exception_when_constructing_with_empty_string()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('__construct', ['']);
        $this->shouldThrow(\InvalidArgumentException::class)->during('__construct', ['   ']);
    }
}
