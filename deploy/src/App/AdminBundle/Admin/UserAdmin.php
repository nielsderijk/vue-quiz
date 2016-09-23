<?php

namespace App\AdminBundle\Admin;

use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @package App\AdminBundle\Admin
 * @author Robert Slootjes <robert@mediamonks.com>
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class UserAdmin extends AbstractAdmin
{
    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * {@inheritdoc}
     */
    public function getFormBuilder()
    {
        $this->formOptions['data_class'] = $this->getClass();
        $options = $this->formOptions;

        if (!$this->getSubject() || $this->getSubject()->getId() === null) {
            $options['validation_groups'] = 'Registration';
        } else {
            $options['validation_groups'] = 'Profile';
        }

        $formBuilder = $this->getFormContractor()->getFormBuilder($this->getUniqid(), $options);

        $this->defineFormBuilder($formBuilder);

        return $formBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        // Prevent security fields from being exported.
        return array_filter(
            parent::getExportFields(),
            function ($v) {
                return !in_array($v, ['password', 'salt']);
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('groups')
            ->add('enabled', null, ['editable' => true])
            ->add('locked', null, ['editable' => true])
            ->add('createdAt');

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $listMapper->add(
                'impersonating',
                'string',
                [
                    'template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig',
                ]
            );
        }

        $listMapper->add(
            '_action',
            'actions',
            [
                'actions'  => [
                    'edit'   => [],
                    'delete' => [],
                ],
                'label' => 'Action',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('username')
            ->add('locked')
            ->add('email')
            ->add('groups');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        if (!$this->isGranted('SELF')) {
            throw new AccessDeniedHttpException(
                'You do not have the right permissions.'
            );
        }

        $showMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->end()
            ->with('Groups')
            ->add('groups')
            ->end()
            ->with('Profile')
            ->add('dateOfBirth')
            ->add('firstname')
            ->add('lastname')
            ->add('website')
            ->add('biography')
            ->add('gender')
            ->add('locale')
            ->add('timezone')
            ->add('phone')
            ->end()
            ->with('Social')
            ->add('facebookUid')
            ->add('facebookName')
            ->add('twitterUid')
            ->add('twitterName')
            ->add('gplusUid')
            ->add('gplusName')
            ->end()
            ->with('Security')
            ->add('token')
            ->add('twoStepVerificationCode')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if (!$this->isGranted('SELF')) {
            throw new AccessDeniedHttpException(
                'You do not have the right permissions.'
            );
        }

        $formMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'password', [
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
            ])
            ->end()
            ->with('Profile')
            ->add('avatar', null, ['required' => false, 'label' => 'Avatar'])
            ->add('firstname', null, ['required' => false])
            ->add('lastname', null, ['required' => false])
            ->add('locale', 'locale', ['required' => false])
            ->add('timezone', 'timezone', ['required' => false])
            ->end()
            ->with('Social')
            ->add('facebookUid', null, ['required' => false])
            ->add('facebookName', null, ['required' => false])
            ->add('twitterUid', null, ['required' => false])
            ->add('twitterName', null, ['required' => false])
            ->add('gplusUid', null, ['required' => false])
            ->add('gplusName', null, ['required' => false])
            ->end();

        if ($this->isGranted('MANAGE_ROLES') && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                ->add(
                    'realRoles',
                    'sonata_security_roles',
                    [
                        'label'    => 'form.label_roles',
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false,
                    ]
                )
                ->add('locked', null, ['required' => false])
                ->add('expired', null, ['required' => false])
                ->add('enabled', null, ['required' => false])
                ->add('credentialsExpired', null, ['required' => false])
                ->end();
        }

        $formMapper
            ->with('Security')
            ->add('token', null, ['required' => false])
            ->add('twoStepVerificationCode', null, ['required' => false])
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->updatePassword($user);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($user)
    {
        $this->updatePassword($user);
    }

    /**
     * @param $user
     */
    protected function updatePassword($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
}
