<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\Form\Type\DateRangeType;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;

class SamplingActivityAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
	    $formMapper
            ->add('project', ModelListType::class)
            ->add('samplingPartners', null, [
                'label' => 'Sampling partners',
                'required' => true
            ])
            ->add('species', null, [
                'label' => 'Species',
                'required' => true
            ])
            ->add('countries', null, [
                'label' => 'Countries',
                'required' => true
            ])
            ->add('description')
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
            ->add('samplingDocuments', null, [
                'label' => 'Sampling documents',
                'required' => false
            ])
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('project')
            ->add('samplingPartners')
            ->add('species')
            ->add('countries')
            ->add('description')
            ->add('startDate', DateRangeFilter::class, [
                'field_type' => DateRangeType::class,
            ])
            ->add('endDate', DateRangeFilter::class, [
                'field_type' => DateRangeType::class,
            ])
            ->add('samplingDocuments.samplingDocumentType', null, [
                'label' => 'Sampling document type'
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('project')
            ->add('samplingPartners')
            ->add('species')
            ->add('countries')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
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
            ->add('id')
            ->add('project')
            ->add('samplingPartners')
            ->add('species')
            ->add('countries')
            ->add('description')
            ->add('startDate')
            ->add('endDate')
            ->add('owner')
            ->add('samplingDocuments', null, [
                'template' => '@SonataAdmin/CRUD/Association/show_many_to_many.html.twig'
            ])
        ;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        $menu->addChild('View Sampling Activity', [
            'uri' => $admin->generateUrl('show', ['id' => $id])
        ]);

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Edit Sampling Activity', [
                'uri' => $admin->generateUrl('edit', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Manage Sampling Documentations', [
                'uri' => $admin->generateUrl('admin.sampling_documentation.list', ['id' => $id])
            ]);
        }
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
