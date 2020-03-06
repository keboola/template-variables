<?php
declare(strict_types=1);

use Keboola\TemplateVariables\Configuration\Definition;

class Variables
{
    /** @var array */
    protected $variablesConfiguration;

    /** @var Mustache_Engine */
    protected $moustache;

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

    public function render(string $template, Context $context)
    {
        return $this->moustache->render($template, $context);
    }
}
