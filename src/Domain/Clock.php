<?php

declare(strict_types=1);

namespace App\Domain;

/**
 * @codeCoverageIgnore
 */
final class Clock
{
    private static ?\DateTimeImmutable $now = null;

    public static function now(?string $relativeFormatInterval = null): \DateTimeImmutable
    {
        $interval = \DateInterval::createFromDateString($relativeFormatInterval ?? '+0 year'); // Fake interval if no format provided
        $now = \DateTimeImmutable::createFromFormat('U', (string) time(), new \DateTimeZone('UTC'));

        if (self::$now) {
            $now = self::$now;
        }

        if (!$now instanceof \DateTimeImmutable) {
            throw new \LogicException('Cannot create DateTime');
        }

        return $now->add($interval);
    }

    public static function setNow(?\DateTimeImmutable $now): void
    {
        self::$now = $now;
    }

    public static function clear(): void
    {
        self::$now = null;
    }
}
