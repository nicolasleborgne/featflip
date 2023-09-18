<?php

use App\Domain\Feature\Feature;
use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Fixtures\Builder\FeatureBuilder;
use App\Tests\Fixtures\Builder\OrganizationBuilder;
use App\Tests\Fixtures\Builder\ProjectBuilder;
use App\Tests\Functional\FeatureManagement\Creation\CreateFeaturePage;

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

function aProject(string $withSlug = null, Organization $withOrganization = null): Project
{
    return projectBuilder()
        ->withName('Some project name')
        ->withSlug($withSlug ?? 'feat-flip')
        ->withOrganizationId($withOrganization?->id() ?? anOrganization()->id())
        ->build();
}

function projectBuilder(): ProjectBuilder
{
    return new ProjectBuilder();
}

function aFeature(Project $withProject = null, string $withKey = null): Feature
{
    return \featureBuilder()
        ->withProjectId($withProject?->id() ?? aProject()->id())
        ->withkey($withKey ?? 'some_feature')
        ->build();
}

function featureBuilder(): FeatureBuilder
{
    return new FeatureBuilder();
}

function createFeaturePage(): CreateFeaturePage
{
    return new CreateFeaturePage();
}
