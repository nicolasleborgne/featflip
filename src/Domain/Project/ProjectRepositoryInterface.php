<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\RepositoryInterface;

/**
 *  @implements RepositoryInterface<Project, ProjectId>
 */
interface ProjectRepositoryInterface extends RepositoryInterface
{
}
