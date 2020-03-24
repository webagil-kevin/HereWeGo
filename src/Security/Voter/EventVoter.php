<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class EventVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['MANAGE'])
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

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'MANAGE':
                // logic to determine if the user can EDIT
                // return true or false
                return $event->getUser()->getId() === $user->getId();
                break;
        }

        return false;
    }
}
