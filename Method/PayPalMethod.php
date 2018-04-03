<?php

namespace Oro\Bundle\PayPalExpressBundle\Method;

use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
use Oro\Bundle\PaymentBundle\Entity\PaymentTransaction;
use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;
use Oro\Bundle\PayPalBundle\Method\Config\PayPalConfigInterface;
use Oro\Bundle\PayPalExpressBundle\Method\Config\PayPalExpressConfigInterface;
use Oro\Bundle\PayPalExpressBundle\Method\PaymentAction\PaymentActionExecutor;
use Oro\Bundle\PayPalExpressBundle\Transport\SupportedCurrenciesHelper;

class PayPalMethod implements PaymentMethodInterface
{
    /**
     * @var PayPalConfigInterface
     */
    protected $config;

    /**
     * @var PaymentActionExecutor
     */
    protected $paymentActionExecutor;

    /**
     * @var SupportedCurrenciesHelper
     */
    protected $supportedCurrenciesHelper;

    /**
     * @param PayPalExpressConfigInterface $config
     * @param PaymentActionExecutor        $paymentActionExecutor
     * @param SupportedCurrenciesHelper    $supportedCurrenciesHelper
     */
    public function __construct(
        PayPalExpressConfigInterface $config,
        PaymentActionExecutor $paymentActionExecutor,
        SupportedCurrenciesHelper $supportedCurrenciesHelper
    ) {
        $this->config = $config;
        $this->paymentActionExecutor = $paymentActionExecutor;
        $this->supportedCurrenciesHelper = $supportedCurrenciesHelper;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Oro\Bundle\PayPalExpressBundle\Exception\ExceptionInterface
     */
    public function execute($action, PaymentTransaction $paymentTransaction)
    {
        return $this->paymentActionExecutor->executeAction($action, $paymentTransaction, $this->config);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->config->getPaymentMethodIdentifier();
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicable(PaymentContextInterface $context)
    {
        return $this->supportedCurrenciesHelper->isSupportedCurrency($context->getCurrency());
    }

    /**
     * @param string $actionName
     *
     * @return bool
     */
    public function supports($actionName)
    {
        return $this->paymentActionExecutor->isActionSupported($actionName);
    }
}
