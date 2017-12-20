<?php

namespace Spec\Ats\ApplicantTracking\Domain\Project;

use Ats\ApplicantTracking\Domain\Project\Exception\InvalidProjectStateTransitionException;
use Ats\ApplicantTracking\Domain\Project\Exception\ProjectMemberAlreadyExists;
use Ats\ApplicantTracking\Domain\Project\Exception\ProjectMemberNotExists;
use Ats\ApplicantTracking\Domain\Project\MemberId;

use Ats\ApplicantTracking\Domain\Project\ProjectId;
use Ats\ApplicantTracking\Domain\Project\ProjectMember;
use Ats\ApplicantTracking\Domain\Project\ProjectNumber;
use Ats\ApplicantTracking\Domain\Project\ProjectState;
use Ats\ApplicantTracking\Domain\Project\ProjectStateTransitionValidator;
use Ats\ApplicantTracking\Domain\Project\ProjectVacancies;
use Ats\ApplicantTracking\Domain\Project\RoleId;
use PhpSpec\ObjectBehavior;


class ProjectSpec extends ObjectBehavior
{

    private const PROJECT = 'Project';

    function let()
    {
        $id = new ProjectId('8a128f2a-a952-4692-877c-33845862f8d5');
        $number = new ProjectNumber('1');
        $name = '' . self::PROJECT . ' 1';
        $description = 'Project 1 description';
        $vacancies = new ProjectVacancies(5);
        $state = new ProjectState('ACTIVE');

        $this->beConstructedWith($id, $number, $name, $description, $vacancies, $state);
    }

    function it_can_be_constructed()
    {
        $this->id()->shouldBeLike(new ProjectId('8a128f2a-a952-4692-877c-33845862f8d5'));
        $this->number()->shouldBeLike(new ProjectNumber('1'));
        $this->name()->shouldReturn('Project 1');
        $this->description()->shouldReturn('Project 1 description');
        $this->state()->shouldBeLike(new ProjectState('ACTIVE'));
        $this->vacancies()->shouldBeLike(new ProjectVacancies(5));
    }

    function it_throws_exception_on_empty_name()
    {
        $this->shouldThrow(\InvalidArgumentException::class)
            ->during('__construct', [
                ProjectId::generate(),
                new ProjectNumber('1'),
                '',
                'Project 1 desc',
                new ProjectVacancies(5),
                new ProjectState('ACTIVE'),
            ]);

        $this->shouldThrow(\InvalidArgumentException::class)
            ->during('__construct', [
                ProjectId::generate(),
                new ProjectNumber('1'),
                '  ',
                'Project 1 desc',
                new ProjectVacancies(5),
                new ProjectState('ACTIVE'),
            ]);
    }

    function it_can_be_renamed()
    {
        $this->rename('Project 1 new name');
        $this->name()->shouldReturn('Project 1 new name');
    }

    function it_cant_be_renamed_with_empty_string()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('rename', ['']);
    }

    function it_can_be_described()
    {
        $this->describe('Project 1 new description');

        $this->description()->shouldReturn('Project 1 new description');
    }

    function it_allows_to_change_status(ProjectStateTransitionValidator $transitionValidator)
    {
        $transitionValidator
            ->validateTransition(new ProjectState('ACTIVE'), new ProjectState('INACTIVE'))
            ->shouldBeCalled()
            ->willReturn(true);

        $this->changeState($transitionValidator, new ProjectState('INACTIVE'));

        $this->state()->shouldBeLike(new ProjectState('INACTIVE'));
    }

    function it_throws_exception_on_invalid_transition(ProjectStateTransitionValidator $transitionValidator)
    {
        $transitionValidator
            ->validateTransition(new ProjectState('ACTIVE'), new ProjectState('NEW'))
            ->shouldBeCalled()
            ->willReturn(false);

        $this->shouldThrow(InvalidProjectStateTransitionException::class)->during('changeState',
            [$transitionValidator, new ProjectState('NEW')]);

        $this->state()->shouldBeLike(new ProjectState('ACTIVE'));
    }

    function it_allows_to_change_vacancies()
    {
        $this->changeVacancies(new ProjectVacancies(10));

        $this->vacancies()->shouldBeLike(new ProjectVacancies(10));
    }

    function it_allows_to_assign_member()
    {
        $member = new ProjectMember(MemberId::generate(), new RoleId('MANAGER'));

        $this->assignMember($member);

        $this->members()->shouldReturn([$member]);
    }

    function it_allows_to_check_if_member_exists()
    {
        $member = new ProjectMember(MemberId::generate(), new RoleId('MANAGER'));

        $this->assignMember($member);

        $this->isMember($member->memberId())->shouldReturn(true);
        $this->isMember(MemberId::generate())->shouldReturn(false);

    }

    function it_throws_exception_on_assigning_existing_member()
    {
        $member = new ProjectMember(MemberId::generate(), new RoleId('MANAGER'));

        $this->assignMember($member);

        $this->shouldThrow(ProjectMemberAlreadyExists::class)
            ->during('assignMember', [
                $member,
            ]);
    }

    function it_allows_to_unassign_member()
    {
        $member = new ProjectMember(MemberId::generate(), new RoleId('MANAGER'));

        $this->assignMember($member);
        $this->unassignMember($member->memberId());

        $this->members()->shouldReturn([]);
    }


    function it_throws_exception_on_unassigning_non_existing_member()
    {
        $member = new ProjectMember(MemberId::generate(), new RoleId('MANAGER'));

        $this->shouldThrow(ProjectMemberNotExists::class)
            ->during('unassignMember', [
                $member->memberId(),
            ]);
    }

}
