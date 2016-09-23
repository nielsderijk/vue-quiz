<?php

namespace App\AdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\UserBundle\Admin\Entity\GroupAdmin as BaseGroupAdmin;

/**
 * @package App\AdminBundle\Admin
 */
class GroupAdmin extends BaseGroupAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name');
    }
}
