<?php

namespace App\AdminBundle\Security;

use App\CoreBundle\Entity\User;
use App\AdminBundle\Admin\UserAdmin;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @package App\AdminBundle\Security
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class UserVoter extends Voter
{
    /**
     * @param string $attribute
     * @param object $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!$subject instanceof UserAdmin) {
            return false;
        }

        return $attribute === 'ROLE_SONATA_USER_ADMIN_USER_SELF';
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $authenticatedUser = $token->getUser();
        $subject = $subject->getSubject();

        if (!$authenticatedUser instanceof User) {
            return false;
        }

        return $authenticatedUser === $subject;
    }
}
