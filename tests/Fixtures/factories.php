<?php

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Fixtures\Builder\OrganizationBuilder;

function anOrganization(string $withSlug = null): Organization
{
    return organizationBuilder()
        ->withName('feat flip')
        ->withSlug($withSlug ?? 'feat-flip')
        ->build();
}

function organizationBuilder(): OrganizationBuilder
{
    return new OrganizationBuilder();
}

function aProject(): Project
{
    return new Project(
        'Some project name',
        'some-project-name',
        anOrganization()->id(),
    );
}
