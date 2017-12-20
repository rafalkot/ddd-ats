<?php

declare (strict_types=1);

namespace Ats\ApplicantTracking\Domain\Project;

use Ats\ApplicantTracking\Domain\Project\Exception\InvalidProjectStateTransitionException;
use Ats\ApplicantTracking\Domain\Project\Exception\ProjectMemberAlreadyExists;
use Ats\ApplicantTracking\Domain\Project\Exception\ProjectMemberNotExists;
use Webmozart\Assert\Assert;

final class Project
{
    /**
     * @var ProjectId
     */
    private $id;

    /**
     * @var ProjectNumber
     */
    private $number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ProjectState
     */
    private $state;

    /**
     * @var ProjectVacancies
     */
    private $vacancies;

    /**
     * @var ProjectMember[]
     */
    private $members = [];

    public function __construct(
        ProjectId $id,
        ProjectNumber $number,
        string $name,
        string $description,
        ProjectVacancies $vacancies,
        ProjectState $state
    ) {
        $this->id = $id;
        $this->number = $number;
        $this->setName($name);
        $this->setDescription($description);
        $this->state = $state;
        $this->vacancies = $vacancies;
    }

    public function id(): ProjectId
    {
        return $this->id;
    }

    public function number(): ProjectNumber
    {
        return $this->number;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description();
    }

    public function rename(string $newName): void
    {
        $this->setName($newName);
    }

    public function describe(string $newDescription): void
    {
        $this->setDescription($newDescription);
    }

    private function setName(string $name): void
    {
        $name = trim($name);

        Assert::stringNotEmpty($name, 'Project name cannot be empty');

        $this->name = $name;
    }

    private function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function changeState(ProjectStateTransitionValidator $transitionValidator, ProjectState $newState): void
    {
        if (!$transitionValidator->validateTransition($this->state(), $newState)) {
            throw InvalidProjectStateTransitionException::invalidTransition($this->state(), $newState);
        }

        $this->state = $newState;
    }

    public function state(): ProjectState
    {
        return $this->state;
    }

    public function vacancies(): ProjectVacancies
    {
        return $this->vacancies;
    }

    public function changeVacancies(ProjectVacancies $vacancies): void
    {
        $this->vacancies = $vacancies;
    }

    public function assignMember(ProjectMember $member): void
    {
        if ($this->isMember($member->memberId())) {
            throw new ProjectMemberAlreadyExists($member->memberId(), $this->id());
        }

        $this->members[] = $member;
    }

    public function members(): array
    {
        return $this->members;
    }

    public function isMember(MemberId $id): bool
    {
        $count = count(array_filter($this->members, function (ProjectMember $projectMember) use ($id) {
            return $projectMember->memberId()->equals($id);
        }));

        return $count === 1;
    }

    public function unassignMember(MemberId $id)
    {
        if (!$this->isMember($id)) {
            throw new ProjectMemberNotExists($id, $this->id());
        }

        $this->members = array_filter($this->members, function (ProjectMember $projectMember) use ($id) {
            return !$projectMember->memberId()->equals($id);
        });
    }
}
