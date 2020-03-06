<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    public function testGetContexts(): void
    {
        $template = file_get_contents(__DIR__ . '/data/config.json');
        $variablesConfiguration = json_decode(file_get_contents(__DIR__ . '/data/variables.json'), true);
        $variables = new Variables($variablesConfiguration);
        $contexts = $variables->getContexts();

        $rendered = [];
        /** @var Context $context */
        foreach ($contexts as $context) {
            $rendered[] = json_decode($variables->render($template, $context), true);
        }

        $this->assertCount(2, $rendered);
        $this->assertEquals(
            $contexts[0]['variable3'],
            $rendered[0]['configuration']['storage']['input'][0]['whereValues']
        );
        $this->assertEquals(
            sprintf('out.c-my.table%s', $contexts[0]['variable1']),
            $rendered[0]['configuration']['storage']['output'][0]['destination']
        );
    }

}
