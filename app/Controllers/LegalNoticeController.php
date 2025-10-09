<?php

require_once __DIR__ . '/../Views/LegalNoticeView.php';

class LegalNoticeController
{
    public function legalnotice(): void
    {
        $view = new LegalNoticeView();
        $view->display();
    }
}