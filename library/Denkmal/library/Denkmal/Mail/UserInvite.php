<?php

class Denkmal_Mail_UserInvite extends CM_Mail {

    /**
     * @param Denkmal_Model_UserInvite $userInvite
     * @throws CM_Exception_Invalid
     */
    public function __construct(Denkmal_Model_UserInvite $userInvite) {
        $site = new Denkmal_Site();
        if (null === $userInvite->getEmail()) {
            throw new CM_Exception_Invalid('Invite has no email');
        }

        parent::__construct($userInvite->getEmail(), array(
            'userInvite' => $userInvite,
        ), $site);
    }
}
