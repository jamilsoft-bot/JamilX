<?php
/**
 * Normalizes CLI input names for classes and files.
 */
class JX_ConsoleNaming
{
    /**
     * Converts input into StudlyCase for class names.
     *
     * @param string $name Raw input name.
     * @return string
     */
    public function classify($name)
    {
        $name = preg_replace('/[^a-zA-Z0-9_\-]/', '', $name);
        $parts = preg_split('/[_\-]+/', $name);
        $parts = array_map('ucfirst', array_filter($parts));
        return implode('', $parts);
    }

    /**
     * Converts input into snake_case for file names.
     *
     * @param string $name Raw input name.
     * @return string
     */
    public function fileName($name)
    {
        $name = preg_replace('/[^a-zA-Z0-9_\-]/', '', $name);
        $name = preg_replace('/([a-z])([A-Z])/', '$1_$2', $name);
        return strtolower(str_replace('-', '_', $name));
    }
}
