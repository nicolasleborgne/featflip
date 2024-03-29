<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Tests\ContainerAwareTestCaseInterface;
use App\Tests\ContainerAwareTestCaseTrait;
use App\Tests\Fixtures\Builder\Builder;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UnitTestCase extends KernelTestCase implements ContainerAwareTestCaseInterface
{
    use ContainerAwareTestCaseTrait;

    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::bootKernel();
        $this->container = self::getContainer();
        Builder::$testCase = $this;
    }
}
