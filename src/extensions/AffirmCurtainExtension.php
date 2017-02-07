<?php

/**
 * Created by PhpStorm.
 * User: mannyarias
 * Date: 2/7/17
 * Time: 1:58 PM
 */
class AffirmCurtainExtension extends PHUICurtainExtension {

    const EXTENSIONKEY = 'affirm.affirm';

    public function shouldEnableForObject($object) {
        return true;
//        return ($object instanceof PhabricatorProjectInterface);
    }

    public function getExtensionApplication() {
        return new PhabricatorProjectApplication();
    }

    public function buildCurtainPanel($object) {
        return $this->newPanel()
            ->setHeaderText(pht('Affirm'))
            ->setOrder(1000)
            ->appendChild(phutil_tag('em', array(), pht('None')));
    }
}