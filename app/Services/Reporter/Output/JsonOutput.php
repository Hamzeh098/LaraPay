<?php


namespace App\Services\Reporter\Output;


class JsonOutput implements OutputReporter
{
    public function Output($data)
    {
        if (is_array($data)) {
            return json_encode($data);
        }
    }

}