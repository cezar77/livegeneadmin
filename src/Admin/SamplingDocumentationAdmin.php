<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\MediaBundle\Form\Type\MediaType;

class SamplingDocumentationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $formMapper
            ->add('samplingActivity', ModelListType::class)
            ->add('samplingDocumentType', ModelListType::class)
            ->add('document', MediaType::class, [
                'provider' => 'sonata.media.provider.file',
                'context' => 'default'
            ])
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('samplingActivity')
            ->add('samplingDocumentType')
            ->add('document')
            ->add('owner')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('samplingActivity')
            ->add('samplingDocumentType')
            ->add('document')
            ->add('owner')
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
            ->add('samplingActivity')
            ->add('samplingDocumentType')
            ->add('document')
            ->add('owner')
            ->add('file', null, [
                'template' => 'SonataAdmin/CRUD/SamplingDocumentation/show_file.html.twig'
            ])
        ;
    }

    public function prePersist($object)
    {
        $user = $this
                    ->getConfigurationPool()
                    ->getContainer()
                    ->get('security.token_storage')
                    ->getToken()
                    ->getUser()
                ;
        $object->setOwner($user);
    }
}
