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
        $listMapper
            ->addIdentifier('country')
            ->add('countryName')
            ->add('flag', null, [
                'sortable' => false,
                'template' => 'SonataAdmin/CRUD/country_list_flag.html.twig'
            ])
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
            ->add('country', null, array(
                'label' => 'ISO 3166-1 alpha-2 code'
            ))
            ->add('countryName', null, array(
                'label' => 'Country name'
            ))
        ;
    }
}
