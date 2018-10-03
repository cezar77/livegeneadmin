<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\SamplingDocumentType;
use App\Entity\SamplingActivity;

class SamplingDocumentationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $formMapper
            ->add('samplingActivity', EntityType::class, array(
                'class' => SamplingActivity::class,
                'placeholder' => '-- choose a sampling activity --'
            ))
            ->add('samplingDocumentType', EntityType::class, array(
                'class' => SamplingDocumentType::class,
                'placeholder' => '-- choose a document type --'
            ))
            ->add('document', FileType::class)
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
        ;
    }
}
