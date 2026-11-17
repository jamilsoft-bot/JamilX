<?php

/**
 * KamalERP V3 default entry service.
 *
 * This service keeps KamalERP's guest entry page behind the JamilX
 * service-routing layer. The KamalERP app provides the container.
 */
class kamalerp extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('KamalERP');
    }

    public function main()
    {
        include "Apps/kamalr/v3/containers/default.php";
    }
}
