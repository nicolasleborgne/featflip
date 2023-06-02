<?php

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;

function anOrganization(): Organization
{
    return new Organization('feat flip', 'feat-flip');
}

function aProject(): Project
{
    return new Project('Some project name');
}
