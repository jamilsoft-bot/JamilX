<?php
/**
 * Loads and renders stub templates for generators.
 */
class JX_ConsoleStub
{
    /**
     * @var string
     */
    private $stubPath;

    /**
     * @param string $stubPath Base path for stub templates.
     */
    public function __construct($stubPath)
    {
        $this->stubPath = rtrim($stubPath, DIRECTORY_SEPARATOR);
    }

    /**
     * Renders a stub template with variable replacements.
     *
     * @param string $name Stub filename.
     * @param array $variables Variables to replace in template.
     * @return string
     * @throws JX_ConsoleException When stub is missing.
     */
    public function render($name, array $variables)
    {
        $path = $this->stubPath . DIRECTORY_SEPARATOR . $name;
        if (!is_file($path)) {
            throw new JX_ConsoleException('Stub not found: ' . $name, 2);
        }
        $contents = file_get_contents($path);
        foreach ($variables as $key => $value) {
            $contents = str_replace('{{' . $key . '}}', $value, $contents);
        }
        return $contents;
    }
}
