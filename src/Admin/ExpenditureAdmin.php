<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ExpenditureAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('ilriCode')
            ->add('name')
            ->add('homeProgram')
            ->add('startDate', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('endDate', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('reportDate', DateTimeType::class, array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ))
            ->add('totalBudget')
            ->add('amount')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('ilriCode')
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('ilriCode')
            ->add('name')
            ->add('homeProgram')
            ->add('startDate')
            ->add('endDate')
            ->add('reportDate')
            ->add('totalBudget')
            ->add('amount')
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
            ->add('name')
            ->add('homeProgram')
            ->add('startDate')
            ->add('endDate')
            ->add('reportDate')
            ->add('totalBudget')
            ->add('amount')
        ;
    }
}
