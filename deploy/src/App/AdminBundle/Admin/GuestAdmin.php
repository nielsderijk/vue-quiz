<?php

namespace App\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * @package App\AdminBundle\Admin
 */
class GuestAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by' => 'updatedAt',
    ];

    /**
     * @return array
     */
    public function getExportFields()
    {
        return [
            'firstName',
            'lastName',
            'email',
            'consentTerms',
            'overEighteen',
            'updateReceiver',
            'createdAt',
        ];
    }

    /**
     * @return array
     */
    public function getExportFormats()
    {
        return ['csv', 'xls'];
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('uuid', null, [
                'label' => 'UUID',
            ])
            ->add('firstName')
            ->add('statusMessage', null, [
                'label' => 'Status',
            ])
            ->add('station')
            ->add('updatedAt', null, [
                'label' => 'Last updated',
            ])
        ;

        $listMapper->add(
            '_action',
            'actions',
            [
                'actions' => [
                    'show' => [],
                ],
                'label' => 'Action',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Info')
            ->add('uuid', 'url', [
                'route' => [
                    'name' => 'front_end_guest',
                    'identifier_parameter_name' => 'uuid',
                ],
                'label' => 'UUID',
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('consentTerms')
            ->add('overEighteen')
            ->add('updateReceiver')
            ->add('statusMessage', null, [
                'label' => 'Status',
            ])
            ->add('phase')
            ->add('station')
            ->add('random360VideoId')
            ->add('hasReceivedEmail', 'boolean')
            ->end()
            ->with('Events')
            ->add('createdAt', null, [
                'label' => 'Date/time created',
            ])
            ->add('updatedAt', null, [
                'label' => 'Date/time last updated',
            ])
            ->add('vrOneAssign', null, [
                'label' => 'Date/time assigned to VR1',
            ])
            ->add('vrOneStart', null, [
                'label' => 'Date/time started VR1',
            ])
            ->add('vrOneFinish', null, [
                'label' => 'Date/time finished VR1',
            ])
            ->add('vrTwoAssign', null, [
                'label' => 'Date/time assigned to VR2',
            ])
            ->add('vrTwoStart', null, [
                'label' => 'Date/time started VR2',
            ])
            ->add('vrTwoFinish', null, [
                'label' => 'Date/time finished VR2',
            ])
            ->end()
            ->with('Artwork Image')
            ->add('imageViewer', null, [
                'template' => 'AppAdminBundle:Guest:show_artwork_image_viewer.html.twig',
            ])
            ->end()
        ;
    }
}
