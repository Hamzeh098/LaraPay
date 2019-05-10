<?php


namespace App\Services\Reporter\Output;


class HtmlOutput implements OutputReporter
{

    public function Output($data)
    {
     return '<h1>$data</h1>';
    }
}