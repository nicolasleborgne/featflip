<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Form\Type;

use App\Domain\Project\EnvironmentId;
use App\Domain\Project\FeatureId;
use App\Domain\Project\ProjectId;
use App\UseCases\SetFlag\SetFlagRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @codeCoverageIgnore
 */
final class SetFlagRequestType extends AbstractType implements DataMapperInterface
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value', CheckboxType::class)
            ->add('project_id', HiddenType::class)
            ->add('feature_id', HiddenType::class)
            ->add('environment_id', HiddenType::class)
            ->add('add', SubmitType::class)
            ->setDataMapper($this)
        ;
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'empty_data' => null,
        ]);
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
        // there is no data yet, so nothing to prepopulate
        // @codeCoverageIgnoreStart
        if (null === $viewData) {
            return;
        }

        /*
         * @codeCoverageIgnore
         */
        if (!is_array($viewData)
            || !isset($viewData['project_id'])
            || !isset($viewData['environment_id'])
            || !isset($viewData['feature_id'])
        ) {
            return;
        }
        // @codeCoverageIgnoreEnd

        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);
        $forms['project_id']->setData($viewData['project_id']);
        $forms['environment_id']->setData($viewData['environment_id']);
        $forms['feature_id']->setData($viewData['feature_id']);
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        // as data is passed by reference, overriding it will change it in
        // the form object as well
        // beware of type inconsistency, see caution below
        $viewData = new SetFlagRequest(
            ProjectId::fromString($forms['project_id']->getData()),
            EnvironmentId::fromString($forms['environment_id']->getData()),
            FeatureId::fromString($forms['feature_id']->getData()),
            (bool) $forms['value']->getData()
        );
    }
}
