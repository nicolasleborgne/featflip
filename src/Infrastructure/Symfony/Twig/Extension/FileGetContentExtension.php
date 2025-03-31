<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class FileGetContentExtension extends AbstractExtension
{
    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('source_url', [$this, 'sourceUrl']),
        ];
    }

    public function sourceUrl(string $path): string
    {
        return (string) file_get_contents($this->requestStack->getMainRequest()->getSchemeAndHttpHost().$path);
    }
}
