<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Project description')
                ->add('ilriCode', null, array(
                    'label' => 'ILRI code'
                ))
                ->add('fullName')
                ->add('shortName')
                ->add('principalInvestigator', null, array(
                    'placeholder' => '-- please choose a person --'
                ))
                ->add('projectsGroup')
                ->add('donorReference')
                ->add('donorProjectName')
            ->end()
            ->with('Project length', array('class' => 'col-md-6'))
                ->add('startDate', DatePickerType::class)
                ->add('endDate', DatePickerType::class)
            ->end()
            ->with('Project features', array('class' => 'col-md-6'))
                ->add('status', null, array(
                    'attr' => array(
                        'min' => 0,
                        'max' => 100,
                    )
                ))
                ->add('capacityDevelopment', null, array(
                    'attr' => array(
                        'min' => 0,
                        'max' => 100,
                    )
                ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('shortName')
            ->add('fullName')    
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('shortName')
            ->add('fullName')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
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
            ->add('startDate')
            ->add('endDate')
            ->add('status')
            ->add('capacityDevelopment')
        ;
    }
}
