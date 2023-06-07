<?php

declare(strict_types=1);

namespace App\Tests;

use Psr\Container\ContainerInterface;

trait ContainerAwareTestCaseTrait
{
    private ContainerInterface $container;

    public function container(): ContainerInterface
    {
        return $this->container;
    }
}
