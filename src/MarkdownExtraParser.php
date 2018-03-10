<?php

namespace AdrianBaez\Bundle\MarkdownBundle;

use ParsedownExtra;

class MarkdownExtraParser extends MarkdownParser
{
    public function __construct()
    {
        $this->parser = new ParsedownExtra;
    }
}
