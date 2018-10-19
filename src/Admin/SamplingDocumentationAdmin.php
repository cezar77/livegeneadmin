<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sonata\MediaBundle\Form\Type\MediaType;
use App\Entity\SamplingDocumentType;
use App\Entity\SamplingActivity;

class SamplingDocumentationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $formMapper
            ->add('samplingActivity', EntityType::class, [
                'class' => SamplingActivity::class,
                'placeholder' => '-- please choose a sampling activity --'
            ])
            ->add('samplingDocumentType', EntityType::class, [
                'class' => SamplingDocumentType::class,
                'placeholder' => '-- please choose a document type --'
            ])
            ->add('document', MediaType::class, [
                'provider' => 'sonata.media.provider.file',
                'context' => 'default'
            ])
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('document');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('samplingActivity')
            ->add('samplingDocumentType')
            ->add('document')
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
            ->add('file', null, [
                'template' => 'SonataAdmin/CRUD/document_show_file.html.twig'
            ])
        ;
    }
}
