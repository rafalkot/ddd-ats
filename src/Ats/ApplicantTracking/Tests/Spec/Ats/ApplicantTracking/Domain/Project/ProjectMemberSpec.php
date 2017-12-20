<?php

namespace Spec\Ats\ApplicantTracking\Domain\Project;

use Ats\ApplicantTracking\Domain\Project\MemberId;

use Ats\ApplicantTracking\Domain\Project\RoleId;
use PhpSpec\ObjectBehavior;


class ProjectMemberSpec extends ObjectBehavior
{
     function let()
     {
         $this->beConstructedWith(new MemberId('a465cf01-70c4-42ea-88cc-ef922899d44d'), new RoleId('MANAGER'));
     }

     function it_allows_to_get_member_id()
     {
         $this->memberId()->shouldBeLike(new MemberId('a465cf01-70c4-42ea-88cc-ef922899d44d'));
     }

    function it_allows_to_get_role_id()
    {
        $this->roleId()->shouldBeLike(new RoleId('MANAGER'));
    }
}
