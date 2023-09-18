<?php

declare(strict_types=1);

namespace App\Tests;

use Psr\Container\ContainerInterface;

trait ContainerAwareTestCaseTrait
{
    public function container(): ContainerInterface
    {
        if (!method_exists(static::class, 'getContainer')) {
            throw new \Error('Your test case class should provide a self::getContainer() method for this trait to work.');
        }

        return self::getContainer();
    }
}
