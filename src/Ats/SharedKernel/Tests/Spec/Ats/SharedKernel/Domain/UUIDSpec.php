<?php

namespace Spec\Ats\SharedKernel\Domain;

use Ats\SharedKernel\Domain\UUID;
use Ats\SharedKernel\Domain\Exception\InvalidUUIDException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UUIDSpec extends ObjectBehavior
{
    function it_can_be_constructed_with_string()
    {
        $this->beConstructedWith('8a128f2a-a952-4692-877c-33845862f8d5');

        $this->id()->shouldReturn('8a128f2a-a952-4692-877c-33845862f8d5');
    }

    function it_can_be_casted_to_string()
    {
        $this->beConstructedWith('8a128f2a-a952-4692-877c-33845862f8d5');

        $this->__toString()->shouldReturn('8a128f2a-a952-4692-877c-33845862f8d5');

    }

    function it_is_comparable()
    {
        $this->beConstructedWith('8a128f2a-a952-4692-877c-33845862f8d5');

        $uuid1 = new UUID('8a128f2a-a952-4692-877c-33845862f8d5');
        $uuid2 = new UUID('a5f65505-442e-43d5-9b23-13460cd91388');

        $this->equals($uuid1)->shouldReturn(true);
        $this->equals($uuid2)->shouldReturn(false);
    }

    function it_throws_exception_on_invalid_uuid()
    {
        $this
            ->shouldThrow(InvalidUUIDException::class)
            ->during('__construct', ['34fh983f43j']);
    }
}
