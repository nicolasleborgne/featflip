<?php

declare(strict_types=1);

namespace App\Tests;

use Psr\Container\ContainerInterface;

interface ContainerAwareTestCaseInterface
{
    public function container(): ContainerInterface;
}
