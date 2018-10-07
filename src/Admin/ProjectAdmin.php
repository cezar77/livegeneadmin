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
            ->with('Project description')
                ->add('ilriCode', null, array(
                    'label' => 'ILRI code'
                ))
                ->add('fullName')
                ->add('shortName')
                ->add('principalInvestigator', ModelListType::class)
                ->add('projectsGroup')
                ->add('donorReference')
                ->add('donorProjectName')
            ->end()
            ->with('Project length', array('class' => 'col-md-6'))
                ->add('startDate', DatePickerType::class, [
                    'dp_pick_time' => false,
                    'format' => DateType::HTML5_FORMAT
                ])
                ->add('endDate', DatePickerType::class, [
                    'dp_pick_time' => false,
                    'format' => DateType::HTML5_FORMAT
                ])
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
        $listMapper->addIdentifier('ilriCode', null, ['label' => 'ILRI code'])
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
