<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types;

use App\Domain\Project\FeatureId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;

#[CodeCoverageIgnore]
final class FeatureIdType extends GuidType
{
    public const FEATURE_ID = 'feature_id';

    #[\Override]
    public function getName(): string
    {
        return self::FEATURE_ID;
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): FeatureId
    {
        return new FeatureId($value);
    }
}
