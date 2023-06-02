<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Assertions\Assert;
use App\Tests\Functional\OrganizationManagement\Creation\CreateOrganizationPage;
use App\Tests\Functional\ProjectManagement\Creation\CreateProjectPage;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FunctionalTestCase extends WebTestCase
{
    public static KernelBrowser $client;

    private const Pages = [
        CreateOrganizationPage::class,
        CreateProjectPage::class,
    ];

    private ContainerInterface $container;
    private UrlGeneratorInterface $router;

    protected function setUp(): void
    {
        parent::setUp();

        self::ensureKernelShutdown();
        self::$client = self::createClient();
        self::$client->disableReboot();
        $this->container = self::getContainer();
        /** @var UrlGeneratorInterface $router */
        $router = $this->container->get(UrlGeneratorInterface::class);
        $this->router = $router;
        $this->loadPages();
        Assert::$testCase = $this;
    }

    public function get(string $routeName, array $parameters = []): Crawler
    {
        $url = $this->router->generate($routeName, $parameters);

        return self::$client->request(Request::METHOD_GET, $url);
    }

    public function container(): ContainerInterface
    {
        return $this->container;
    }

    private function loadPages(): void
    {
        foreach (self::Pages as $pageClass) {
            if (method_exists($pageClass, 'setTestCase')) {
                $pageClass::setTestCase($this);
            }
        }
    }
}
