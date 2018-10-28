<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class OrganisationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $organisation = $this->getSubject();

        $fileFieldOptions = ['required' => true];
        if ($organisation && ($webPath = $organisation->getLogoUrl())) {
            $fileFieldOptions['help'] = '<img src="'.$webPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('shortName')
            ->add('fullName')
            ->add('logoUrl', null, $fileFieldOptions)
            ->add('country', ModelListType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('shortName');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('shortName')
            ->add('fullName')
            ->add('logoUrl', null, [
                'label' => 'Logo',
                'sortable' => false,
                'template' => 'SonataAdmin/CRUD/Organisation/list_logo.html.twig'
            ])
            ->add('country', null, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'country'],
                'sort_parent_association_mappings' => [
                    ['fieldName' => 'country']
                ]
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
            ->add('shortName')
            ->add('fullName')
            ->add('logoUrl', null, [
                'label' => 'Logo',
                'template' => 'SonataAdmin/CRUD/Organisation/show_logo.html.twig'
            ])
            ->add('country')
        ;
    }
}
