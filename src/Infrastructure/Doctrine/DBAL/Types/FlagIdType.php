<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types;

use App\Domain\Project\FlagId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;

#[CodeCoverageIgnore]
final class FlagIdType extends GuidType
{
    public const FLAG_ID = 'flag_id';

    #[\Override]
    public function getName(): string
    {
        return self::FLAG_ID;
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): FlagId
    {
        return new FlagId($value);
    }
}
