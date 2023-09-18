<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Domain\Feature\FeatureId;
use App\Domain\Feature\FeatureRepositoryInterface;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

abstract class AbstractFeatureRepositoryTestCaseCase extends UnitTestCase
{
    protected FeatureRepositoryInterface $repository;

    #[Test]
    public function it_add_and_get(): void
    {
        $aFeature = aFeature();
        $this->repository->add($aFeature);

        self::assertEquals($aFeature, $this->repository->get($aFeature->id()));
    }

    #[Test]
    public function it_add_already_existing(): void
    {
        $aFeature = aFeature();
        $this->repository->add($aFeature);
        $this->repository->add($aFeature);

        self::assertCount(1, $this->repository->all());
    }

    #[Test]
    public function it_return_null_when_getting_unknown(): void
    {
        self::assertNull($this->repository->get(FeatureId::generate()));
    }

    #[Test]
    public function it_get_all(): void
    {
        $aFeature = aFeature();
        $anotherFeature = aFeature();
        $this->repository->add($aFeature);
        $this->repository->add($anotherFeature);

        $actualFeatures = $this->repository->all();
        self::assertContains($aFeature, $actualFeatures);
        self::assertContains($anotherFeature, $actualFeatures);
    }
}
