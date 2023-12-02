<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types;

use App\Domain\Project\EnvironmentId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;

#[CodeCoverageIgnore]
final class ProjectEnvironmentIdType extends GuidType
{
    public const PROJECT_ID = 'project_environment_id';

    #[\Override]
    public function getName(): string
    {
        return self::PROJECT_ID;
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): EnvironmentId
    {
        return new EnvironmentId($value);
    }
}
