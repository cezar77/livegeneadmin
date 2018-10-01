<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class CountryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $formMapper->add('country', CountryType::class, array(
                'placeholder' => '-- please choose a country --',
            )
            );
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('country');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('country')
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
        $showMapper->add('country')
            ->add('country.country.fullname')
        ;
    }
}
