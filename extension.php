<?php

class LatexSupportExtension extends Minz_Extension {
    private const MATHJAX_URL = 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js';

    protected array $csp_policies = [
        'default-src' => 'https://cdn.jsdelivr.net',
    ];

    public function init() {
        $this->loadMathjax();
        $this->registerHook('entry_before_display', array($this, 'sanitize'));
    }

    private function loadMathjax() {
        $config = 'mathjax-config.js';
        Minz_View::appendScript($this->getFileUrl($config, 'js'));
        Minz_View::appendScript(self::MATHJAX_URL);
    }

    public function sanitize($entry) {
        $content = str_replace([
            '\\left⌊',
            '\\right⌋',
            '\\Complex',
            '\\Reals'
        ], [
            '\\left\\lfloor',
            '\\right\\rfloor',
            '\mathbb{C}',
            '\mathbb{R}',
        ], $entry->content());

        $entry->_content($content);

        return $entry;
    }
}
