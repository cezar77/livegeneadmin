<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\AdminBundle\Form\Type\ModelListType;

class PartnershipAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('project', ModelListType::class)
            ->add('partner', ModelListType::class)
            ->add('startDate', DatePickerType::class, [
                'required' => false,
                'dp_pick_time' => false,
                'format' => DateType::HTML5_FORMAT
            ])
            ->add('endDate', DatePickerType::class, [
                'required' => false,
                'dp_pick_time' => false,
                'format' => DateType::HTML5_FORMAT
            ])
            ->add('contact', null, [
                'label' => 'Contact person(s)',
                'required' => true,
                'by_reference' => false,
            ])
            ->add('partnershipType', ModelListType::class)
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
            ->add('project', null, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'fullName'],
                'sort_parent_association_mappings' => [
                    ['fieldName' => 'project']
                ]
            ])
            ->add('partner', null, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'fullName'],
                'sort_parent_association_mappings' => [
                    ['fieldName' => 'partner']
                ]
            ])
            ->add('startDate')
            ->add('endDate')
            ->add('contact')
            ->add('partnershipType', null, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'description'],
                'sort_parent_association_mappings' => [
                    ['fieldName' => 'partnershipType']
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
            ->add('project')
            ->add('partner')
            ->add('startDate')
            ->add('endDate')
            ->add('contact')
            ->add('partnershipType')
        ;
    }
}
