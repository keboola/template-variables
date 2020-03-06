<?php
declare(strict_types=1);

use Keboola\TemplateVariables\Configuration\Definition;

class Loader
{
    /** @var Definition */
    protected $definition;

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
