<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StaffRoleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('project', ModelListType::class)
            ->add('person', ModelListType::class)
            ->add('percent', IntegerType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => $this->getSubject()->getAvailablePercents()
                ]
            ])
            ->add('totalPercent', IntegerType::class, [
                'required' => false,
                'disabled' => true,
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('percent');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('project')
            ->add('person')
            ->add('percent')
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
            ->add('person')
            ->add('percent')
            ->add('totalPercent')
        ;
    }
}
