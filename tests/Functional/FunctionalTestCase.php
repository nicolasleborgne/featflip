<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Assertions\Assert;
use App\Tests\ContainerAwareTestCaseInterface;
use App\Tests\ContainerAwareTestCaseTrait;
use App\Tests\Fixtures\Builder\Builder;
use App\Tests\Functional\OrganizationManagement\Creation\CreateOrganizationPage;
use App\Tests\Functional\ProjectManagement\CreateProject\CreateProjectPage;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FunctionalTestCase extends WebTestCase implements ContainerAwareTestCaseInterface
{
    use ContainerAwareTestCaseTrait;

    public static KernelBrowser $client;

    private const Pages = [
        CreateOrganizationPage::class,
        CreateProjectPage::class,
    ];

    private ContainerInterface $container;
    private UrlGeneratorInterface $router;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        self::ensureKernelShutdown();
        self::$client = self::createClient();
        self::$client->disableReboot();
        self::$client->followRedirects();
        $this->container = self::getContainer();
        /** @var UrlGeneratorInterface $router */
        $router = $this->container->get(UrlGeneratorInterface::class);
        $this->router = $router;
        $this->loadPages();
        Assert::$testCase = $this;
        Builder::$testCase = $this;
    }

    /**
     * @param array<string, ?string> $parameters
     * @param array<string, string>  $queryStrings
     */
    public function get(string $routeName, array $parameters = [], array $queryStrings = []): Crawler
    {
        $url = $this->router->generate($routeName, $parameters);

        return self::$client->request(Request::METHOD_GET, $url, $queryStrings);
    }

    public function container(): ContainerInterface
    {
        return $this->container;
    }

    public static function debugHtml(): void
    {
        file_put_contents('test.html', self::$client->getResponse()->getContent());
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
