<?php

namespace AdrianBaez\Bundle\MarkdownBundle\Tests;

use AdrianBaez\Bundle\MarkdownBundle\Helper;

class TestHelper extends Helper
{
    public function hasInstance($instanceName)
    {
        return isset($this->instances[$instanceName]);
    }

    public function getInstance($instanceName)
    {
        return $this->instances[$instanceName];
    }

    public function getDefaultValue($key)
    {
        return $this->defaults[$key];
    }

    public function getInstances()
    {
        return $this->instances;
    }
}
