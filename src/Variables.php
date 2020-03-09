<?php

declare(strict_types=1);

namespace Keboola\TemplateVariables;

use Keboola\TemplateVariables\Configuration\Definition;
use Keboola\TemplateVariables\Configuration\Loader;
use Mustache_Engine;

class Variables
{
    protected array $variablesConfiguration;

    protected Mustache_Engine $moustache;

    public function __construct(array $variablesConfiguration)
    {
        $this->moustache = new Mustache_Engine();
        $loader = new Loader(new Definition());
        $this->variablesConfiguration = $loader->load($variablesConfiguration);
    }

    public function getContexts(): array
    {
        $result = [];
        foreach ($this->variablesConfiguration['rows'] as $row) {
            $result[] = new Context($row);
        }

        return $result;
    }

    public function render(string $template, Context $context): string
    {
        return $this->moustache->render($template, $context);
    }
}
