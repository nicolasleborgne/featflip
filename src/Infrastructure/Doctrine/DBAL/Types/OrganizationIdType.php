<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types;

use App\Domain\Organization\OrganizationId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;

#[CodeCoverageIgnore]
final class OrganizationIdType extends GuidType
{
    public const ORGANIZATION_ID = 'organization_id';

    public function getName(): string
    {
        return self::ORGANIZATION_ID;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): OrganizationId
    {
        return new OrganizationId($value);
    }
}
