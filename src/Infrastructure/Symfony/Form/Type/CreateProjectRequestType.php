<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Form\Type;

use App\Domain\Organization\OrganizationId;
use App\UseCases\CreateProject\CreateProjectRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CreateProjectRequestType extends AbstractType implements DataMapperInterface
{
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('organization_id', HiddenType::class)
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
        if (!is_array($viewData) || !isset($viewData['organization_id'])) {
            return;
        }
        // @codeCoverageIgnoreEnd

        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);
        $forms['organization_id']->setData($viewData['organization_id']);
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        // as data is passed by reference, overriding it will change it in
        // the form object as well
        // beware of type inconsistency, see caution below
        $viewData = new CreateProjectRequest(
            $forms['name']->getData(),
            OrganizationId::fromString($forms['organization_id']->getData()),
        );
    }
}
