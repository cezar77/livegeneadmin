<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PartnershipAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('project')
            ->add('partner')
            ->add('startDate')
            ->add('endDate')
            ->add('contact')
            ->add('partnershipType')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('project')
            ->add('partner')
            ->add('startDate')
            ->add('endDate')
            ->add('contact')
            ->add('partnershipType')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('project')
            ->add('partner')
            ->add('startDate')
            ->add('endDate')
            ->add('contact')
            ->add('partnershipType')
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
            ->add('partner')
            ->add('startDate')
            ->add('endDate')
            ->add('contact')
            ->add('partnershipType')
        ;
    }
}
