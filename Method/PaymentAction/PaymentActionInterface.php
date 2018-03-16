<?php

namespace Oro\Bundle\PayPalExpressBundle\Method\PaymentAction;

use Oro\Bundle\PaymentBundle\Entity\PaymentTransaction;
use Oro\Bundle\PayPalExpressBundle\Method\Config\PayPalExpressConfigInterface;

interface PaymentActionInterface
{
    /**
     * @param PaymentTransaction           $paymentTransaction
     * @param PayPalExpressConfigInterface $config
     *
     * @return array
     */
    public function executeAction(PaymentTransaction $paymentTransaction, PayPalExpressConfigInterface $config);

    /**
     * @return string
     */
    public function getName();
}
