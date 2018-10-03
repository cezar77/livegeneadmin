<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
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
            ->add('startDate', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('endDate', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('status')
            ->add('capacityDevelopment')
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
