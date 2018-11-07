<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\AdminBundle\Form\Type\ModelListType;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Project description', ['class' => 'col-md-8'])
                ->add('ilriCode', null, [
                    'label' => 'ILRI code'
                ])
                ->add('fullName')
                ->add('shortName')
                ->add('principalInvestigator', ModelListType::class)
                ->add('projectsGroup')
                ->add('donorReference')
                ->add('donorProjectName')
            ->end()
            ->with('Project value', ['class' => 'col-md-4'])
                ->add('totalProjectValue', null, [
                    'attr' => [
                        'min' => 1
                    ]
                ])
                ->add('totalIlriValue', null, [
                    'attr' => [
                        'min' => 1
                    ]
                ])
                ->add('totalLivegeneValue', null, [
                    'attr' => [
                        'min' => 1
                    ]
                ])
            ->end()
            ->with('Project length', ['class' => 'col-md-4'])
                ->add('startDate', DatePickerType::class, [
                    'dp_pick_time' => false,
                    'format' => DateType::HTML5_FORMAT
                ])
                ->add('endDate', DatePickerType::class, [
                    'dp_pick_time' => false,
                    'format' => DateType::HTML5_FORMAT
                ])
            ->end()
            ->with('Project features', ['class' => 'col-md-4'])
                ->add('status', null, [
                    'attr' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ])
                ->add('capacityDevelopment', null, [
                    'attr' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('shortName')
            ->add('fullName')    
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('ilriCode', null, ['label' => 'ILRI code'])
            ->add('shortName')
            ->add('fullName')
            ->add('isActive', 'boolean')
            ->add('_action', 'actions', [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ]
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('ilriCode')
            ->add('fullName')
            ->add('shortName')
            ->add('principalInvestigator')
            ->add('projectsGroup')
            ->add('donorReference')
            ->add('donorProjectName')
            ->add('totalProjectValue')
            ->add('totalIlriValue')
            ->add('totalLivegeneValue')
            ->add('startDate')
            ->add('endDate')
            ->add('status')
            ->add('capacityDevelopment')
            ->add('donors', null, [
                'template' => '@SonataAdmin/CRUD/Association/show_many_to_many.html.twig'
            ])
        ;
    }
}
