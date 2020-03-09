<?php

declare(strict_types=1);

namespace Keboola\TemplateVariables;

class Context extends \ArrayObject
{
    protected int $id;
    protected string $name;

    public function __construct(array $configurationRow)
    {
        $this->id = $configurationRow['id'];
        $this->name = $configurationRow['name'];
        parent::__construct($configurationRow['configuration']);
    }
}
