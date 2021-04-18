<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Validator;

use JetBrains\PhpStorm\Pure;
use LogicException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

final class ValidationException extends LogicException
{
    private ConstraintViolationListInterface $violations;

    #[Pure] public function __construct(
        ConstraintViolationListInterface $violations,
        string $message = 'Invalid input.',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->violations = $violations;
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}