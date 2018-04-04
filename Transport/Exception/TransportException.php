<?php

namespace Oro\Bundle\PayPalExpressBundle\Transport\Exception;

use Oro\Bundle\PayPalExpressBundle\Exception\ErrorContextAwareExceptionInterface;
use Oro\Bundle\PayPalExpressBundle\Exception\RuntimeException;

/**
 * Represent specific Transport Exception, contains error context details
 */
class TransportException extends RuntimeException implements ErrorContextAwareExceptionInterface
{
    /**
     * @var array
     */
    protected $errorContext = [];

    /**
     * @param string          $message
     * @param array           $errorContext
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "", array $errorContext = [], \Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->errorContext = $errorContext;
    }

    /**
     * @return array
     */
    public function getErrorContext()
    {
        return $this->errorContext;
    }
}
