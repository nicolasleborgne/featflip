<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\AbstractEntity;
use App\Domain\Common\Slug;
use App\Domain\Organization\OrganizationId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;

final class Project extends AbstractEntity
{
    private ProjectId $id;
    private string $name;
    private string $slug;
    private OrganizationId $organizationId;
    /** @var Collection<int, Environment> */
    private Collection $environmentList;
    /** @var Collection<int, Feature> */
    private Collection $featureList;
    /** @var Collection<int, Flag> */
    private Collection $flagList;

    public function __construct(
        string $name,
        string $slug,
        OrganizationId $organizationId,
    ) {
        $this->id = ProjectId::generate();
        $this->name = $name;
        $this->slug = $slug;
        $this->organizationId = $organizationId;
        $this->environmentList = new ArrayCollection();
        $this->featureList = new ArrayCollection();
        $this->flagList = new ArrayCollection();
    }

    #[\Override]
    public function id(): ProjectId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function organizationId(): OrganizationId
    {
        return $this->organizationId;
    }

    public function hasEnvironment(string $name): bool
    {
        $expr = new Comparison('name', '=', $name);
        $criteria = new Criteria();
        $criteria->where($expr);
        $matches = $this->environmentList->matching($criteria);

        return !$matches->isEmpty();
    }

    public function addEnvironment(string $name): void
    {
        $environment = new Environment($name, Slug::from($name), $this);
        if (!$this->environmentList->contains($environment)) {
            $this->environmentList->add($environment);
        }
    }

    public function addFeature(string $key): void
    {
        $feature = new Feature($this, $key);
        if (!$this->featureList->contains($feature)) {
            $this->featureList->add($feature);
        }
    }

    /** @return Collection<int, Feature> */
    public function features(): Collection
    {
        return $this->featureList;
    }

    public function hasFeature(string $withKey): bool
    {
        $expr = new Comparison('key', '=', $withKey);
        $criteria = new Criteria();
        $criteria->where($expr);
        $matches = $this->featureList->matching($criteria);

        return !$matches->isEmpty();
    }

    /** @return Collection<int, Environment> */
    public function environments(): Collection
    {
        return $this->environmentList;
    }

    public function hasFlag(string $withFeature, string $withEnvironment, bool $withValue): bool
    {
        return
            $this->hasFeature($withFeature)
            && $this->hasEnvironment($withEnvironment)
            && $withValue === $this->flag($withFeature, $withEnvironment)->value()
        ;
    }

    public function flag(string $withFeature, string $withEnvironment): Flag
    {
        $expr = new Comparison('key', Comparison::EQ, $withFeature);
        $criteria = new Criteria();
        $criteria->where($expr);
        $matches = $this->featureList->matching($criteria);
        $feature = $matches->first();

        $expr = new Comparison('slug', Comparison::EQ, $withEnvironment);
        $criteria = new Criteria();
        $criteria->where($expr);
        $matches = $this->environmentList->matching($criteria);
        $environment = $matches->first();

        foreach ($this->flagList as $flag) {
            if ($flag->feature()->equalTo($feature) && $flag->environment()->equalTo($environment)) {
                return $flag;
            }
        }

        return new Flag($environment, $feature, false);
    }

    /**
     * @return Collection<int, Flag>
     */
    public function flags(): Collection
    {
        $list = new ArrayCollection();
        foreach ($this->environmentList as $environment) {
            foreach ($this->featureList as $feature) {
                $list->add(new Flag($environment, $feature, false));
            }
        }

        return $list;
    }

    public function setFlag(FeatureId $withFeature, EnvironmentId $withEnvironment, bool $withValue): void
    {
        $expr = new Comparison('id.__toString', Comparison::EQ, (string) $withFeature);
        $criteria = new Criteria();
        $criteria->where($expr);
        $matches = $this->featureList->matching($criteria);
        $feature = $matches->first();

        $expr = new Comparison('id.__toString', Comparison::EQ, (string) $withEnvironment);
        $criteria = new Criteria();
        $criteria->where($expr);
        $matches = $this->environmentList->matching($criteria);
        $environment = $matches->first();

        foreach ($this->flagList as $flag) {
            if ($flag->feature()->equalTo($feature) && $flag->environment()->equalTo($environment)) {
                $flag->setValue($withValue);

                return;
            }
        }
        $this->flagList->add(new Flag($environment, $feature, $withValue));
    }
}
