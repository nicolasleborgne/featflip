<?php

use App\Domain\Organization\Organization;
use App\Domain\Project\Environment;
use App\Domain\Project\Feature;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\Entity\User;
use App\Tests\Fixtures\Builder\EnvironmentBuilder;
use App\Tests\Fixtures\Builder\FeatureBuilder;
use App\Tests\Fixtures\Builder\OrganizationBuilder;
use App\Tests\Fixtures\Builder\ProjectBuilder;
use App\Tests\Fixtures\Builder\UserBuilder;
use App\Tests\Functional\ProjectManagement\CreateEnvironment\CreateEnvironmentPage;
use App\Tests\Functional\ProjectManagement\CreateFeature\CreateFeaturePage;
use App\Tests\Functional\ProjectManagement\ListFlags\ListFlagsPage;
use App\Tests\Functional\ProjectManagement\SetFlag\SetFlagPage;
use App\Tests\Functional\UserManagement\Login\LoginPage;
use App\Tests\Functional\UserManagement\Register\RegisterPage;
use App\Tests\Functional\UserManagement\ResetPassword\RequestResetPasswordPage;

function anOrganization(?string $withSlug = null): Organization
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
    ?string $withSlug = null,
    ?Organization $withOrganization = null,
    ?string $withEnvironment = null,
    ?string $withFeature = null,
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
// Go thourg project instead
// function anEnvironment(Project $withProject = null): Environment
// {
//    return environmentBuilder()
//        ->withProject($withProject ?? aProject())
//        ->build();
// }
//
// function environmentBuilder(): EnvironmentBuilder
// {
//    return new EnvironmentBuilder();
// }
//
// function aFeature(Project $withProject = null): Feature
// {
//    return \featureBuilder()
//        ->withProject($withProject ?? aProject())
//        ->build();
// }
//
// function featureBuilder(): FeatureBuilder
// {
//    return new FeatureBuilder();
// }

function createFeaturePage(): CreateFeaturePage
{
    return new CreateFeaturePage();
}

function listFlagsPage(): ListFlagsPage
{
    return new ListFlagsPage();
}

function createEnvironmentPage(): CreateEnvironmentPage
{
    return new CreateEnvironmentPage();
}

function setFlagPage(): SetFlagPage
{
    return new SetFlagPage();
}

function loginPage(): LoginPage
{
    return new LoginPage();
}

function userBuilder(): UserBuilder
{
    return new UserBuilder();
}

function aUser(string $withEmail = 'test@test.com', string $withPassword = 'password', bool $withLogin = true): User
{
    return \userBuilder()
        ->withEmail($withEmail)
        ->withPassword($withPassword)
        ->withLogin($withLogin)
        ->build();
}

function registerUserPage(): RegisterPage
{
    return new RegisterPage();
}

function requestResetPasswordPage(): RequestResetPasswordPage
{
    return new RequestResetPasswordPage();
}
