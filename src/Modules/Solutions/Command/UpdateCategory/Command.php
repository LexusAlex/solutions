<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Command\UpdateCategory;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank(
     *     message = "Название категории - не должно быть пустым"
     * )
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    public string $title = '';

    public string $parent_id = '';
}