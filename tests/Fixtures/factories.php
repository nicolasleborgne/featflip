<?php

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Fixtures\Builder\OrganizationBuilder;
use App\Tests\Fixtures\Builder\ProjectBuilder;
use App\Tests\Functional\ProjectManagement\CreateEnvironment\CreateEnvironmentPage;
use App\Tests\Functional\ProjectManagement\CreateFeature\CreateFeaturePage;
use App\Tests\Functional\ProjectManagement\ListFeature\ListFeaturePage;
use App\Tests\Functional\ProjectManagement\SetFlag\SetFlagPage;

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

function aProject(
    string $withSlug = null,
    Organization $withOrganization = null,
    string $withEnvironment = null,
    string $withFeature = null,
): Project {
    return projectBuilder()
        ->withName('Some project name')
        ->withSlug($withSlug ?? 'feat-flip')
        ->withOrganizationId($withOrganization?->id() ?? anOrganization()->id())
        ->withEnvironment($withEnvironment ?? 'test')
        ->withFeatures($withFeature ?? 'track_parcel')
        ->build();
}

function projectBuilder(): ProjectBuilder
{
    return new ProjectBuilder();
}

function createFeaturePage(): CreateFeaturePage
{
    return new CreateFeaturePage();
}

function listFeaturePage(): ListFeaturePage
{
    return new ListFeaturePage();
}

function createEnvironmentPage(): CreateEnvironmentPage
{
    return new CreateEnvironmentPage();
}

function setFlagPage(): SetFlagPage
{
    return new SetFlagPage();
}
