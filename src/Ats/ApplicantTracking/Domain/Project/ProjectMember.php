<?php

declare (strict_types = 1);

namespace Ats\ApplicantTracking\Domain\Project;

final class ProjectMember
{
    /**
     * @var MemberId
     */
    private $memberId;

    /**
     * @var RoleId
     */
    private $roleId;

    /**
     * ProjectMember constructor.
     * @param MemberId $memberId
     * @param RoleId $roleId
     */
    public function __construct(MemberId $memberId, RoleId $roleId)
    {
        $this->memberId = $memberId;
        $this->roleId = $roleId;
    }

    /**
     * @return MemberId
     */
    public function memberId(): MemberId
    {
        return $this->memberId;
    }

    /**
     * @return RoleId
     */
    public function roleId(): RoleId
    {
        return $this->roleId;
    }
}
