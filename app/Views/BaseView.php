<?php

abstract class BaseView
{
    protected array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Render the view and return the HTML content
     */
    abstract public function render(): string;

    /**
     * Display the view (output to browser)
     */
    public function display(): void
    {
        echo $this->render();
    }

    /**
     * Helper method to safely output data
     */
    protected function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Helper method to include template files
     */
    protected function includeTemplate(string $templateName): string
    {
        $templatePath = __DIR__ . '/../../modules/controllers/views/templates/' . $templateName . '.php';
        if (file_exists($templatePath)) {
            ob_start();
            include $templatePath;
            return ob_get_clean();
        }
        return '';
    }
}

