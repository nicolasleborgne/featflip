<?php

declare(strict_types=1);

namespace App\Tests\Assertions;

use App\Domain\Project\Feature;
use App\Domain\Project\Project;

final class AssertFeature extends Assert
{
    public function __construct(
        readonly Feature $feature,
    ) {
    }

    public function hasKey(string $key): self
    {
        parent::$testCase::assertEquals(
            $key,
            $this->feature->key(),
            sprintf('Failed asserting that feature has key %s.', $key)
        );

        return $this;
    }

    //    public function hasProject(Project $project): self
    //    {
    //        parent::$testCase::assertEquals(
    //            $project,
    //            $this->feature->project(),
    //            sprintf('Failed asserting that feature has project %s.', $project),
    //        );
    //
    //        return $this;
    //    }
}
