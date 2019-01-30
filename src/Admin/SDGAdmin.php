<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class SDGAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $sdg = $this->getSubject();

        $fileFieldOptions = ['required' => true];
        if ($sdg && ($webPath = $sdg->getLogoUrl())) {
            $fileFieldOptions['help'] = '<img src="'.$webPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('headline')
            ->add('fullName')
            ->add('color', ColorType::class)
            ->add('link', UrlType::class)
            ->add('logoUrl', null, $fileFieldOptions)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('headline');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('headline')
            ->add('color', null, [
                'template' => 'SonataAdmin/CRUD/SDG/list_color.html.twig'
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
            ->add('headline')
            ->add('fullName')
            ->add('color', null, [
                'template' => 'SonataAdmin/CRUD/SDG/show_color.html.twig'
            ])
            ->add('link', null, [
                'template' => 'SonataAdmin/CRUD/SDG/show_link.html.twig'
            ])
            ->add('logoUrl', null, [
                'label' => 'Logo',
                'template' => 'SonataAdmin/CRUD/SDG/show_logo.html.twig'
            ])
        ;
    }
}
