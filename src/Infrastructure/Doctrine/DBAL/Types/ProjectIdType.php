<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types;

use App\Domain\Project\ProjectId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;

#[CodeCoverageIgnore]
final class ProjectIdType extends GuidType
{
    public const PROJECT_ID = 'project_id';

    #[\Override]
    public function getName(): string
    {
        return self::PROJECT_ID;
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ProjectId
    {
        return new ProjectId($value);
    }
}
