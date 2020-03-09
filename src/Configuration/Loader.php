<?php

declare(strict_types=1);

namespace Keboola\TemplateVariables\Configuration;

class Loader
{
    protected Definition $definition;

    public function __construct(Definition $definition)
    {
        $this->definition = $definition;
    }

    public function load(array $configuration): array
    {
        // todo: add validation
        return $this->definition->processData($configuration);
    }
}
