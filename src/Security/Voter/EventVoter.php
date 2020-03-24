<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class EventVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['MANAGE', 'CRUD'])
            && $subject instanceof \App\Entity\Event;
    }

    protected function voteOnAttribute($attribute, $event, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (!$event->getUser()) {
            return false;
        }

        if (!$this->security->isGranted('ROLE_ORG')) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'CRUD':
                return $event->getUser()->getId() === $user->getId();
                break;
        }

        return false;
    }
}
