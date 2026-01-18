<?php
/**
 * Renders tabular data for CLI output.
 */
class JX_ConsoleTable
{
    /**
     * @var JX_ConsoleOutput
     */
    private $output;

    /**
     * @param JX_ConsoleOutput $output Output helper.
     */
    public function __construct(JX_ConsoleOutput $output)
    {
        $this->output = $output;
    }

    /**
     * Renders the table with headers and rows.
     *
     * @param array $headers Table headers.
     * @param array $rows Table rows.
     * @return void
     */
    public function render(array $headers, array $rows)
    {
        $widths = $this->calculateWidths($headers, $rows);
        $this->output->writeln($this->renderRow($headers, $widths), 'bold');
        $this->output->writeln($this->renderSeparator($widths));

        foreach ($rows as $row) {
            $this->output->writeln($this->renderRow($row, $widths));
        }
    }

    /**
     * Calculates column widths for the table.
     *
     * @param array $headers Table headers.
     * @param array $rows Table rows.
     * @return array
     */
    private function calculateWidths(array $headers, array $rows)
    {
        $widths = [];
        foreach ($headers as $index => $header) {
            $widths[$index] = strlen((string) $header);
        }
        foreach ($rows as $row) {
            foreach ($row as $index => $cell) {
                $widths[$index] = max($widths[$index] ?? 0, strlen((string) $cell));
            }
        }
        return $widths;
    }

    /**
     * Renders a single row with padding.
     *
     * @param array $row Row values.
     * @param array $widths Column widths.
     * @return string
     */
    private function renderRow(array $row, array $widths)
    {
        $cells = [];
        foreach ($widths as $index => $width) {
            $value = isset($row[$index]) ? (string) $row[$index] : '';
            $cells[] = str_pad($value, $width);
        }
        return ' ' . implode(' | ', $cells);
    }

    /**
     * Renders a separator line for the table.
     *
     * @param array $widths Column widths.
     * @return string
     */
    private function renderSeparator(array $widths)
    {
        $segments = [];
        foreach ($widths as $width) {
            $segments[] = str_repeat('-', $width);
        }
        return '-' . implode('-+-', $segments);
    }
}
