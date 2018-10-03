<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SamplingActivityAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $formMapper
            ->add('project', null, array(
                'placeholder' => '-- please choose a project --'
            ))
            ->add('partnership', null, array(
                'placeholder' => '-- please choose a partnership --'
            ))
            ->add('description')
            ->add('startDate', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('endDate', DateType::class, array(
                'widget' => 'single_text'
            ))
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('project')
            ->add('partnership')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
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
            ->add('project')
            ->add('partnership')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
        ;
    }
}
