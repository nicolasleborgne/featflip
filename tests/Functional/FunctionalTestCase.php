<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Functional\OrganizationManagement\Creation\CreateOrganizationPage;
use App\Tests\Functional\ProjectManagement\Creation\CreateProjectPage;
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

    private UrlGeneratorInterface $router;

    protected function setUp(): void
    {
        parent::setUp();

        self::ensureKernelShutdown();
        self::$client = self::createClient();
        /** @var UrlGeneratorInterface $router */
        $router = self::getContainer()->get(UrlGeneratorInterface::class);
        $this->router = $router;
        $this->loadPages();
    }

    public function get(string $routeName, array $parameters = []): Crawler
    {
        $url = $this->router->generate($routeName, $parameters);

        return self::$client->request(Request::METHOD_GET, $url);
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
