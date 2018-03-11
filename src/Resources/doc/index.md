# MarkdownBundle documentation
## Installation

Run this command to install and enable this bundle in your application:

```console
$ composer require adrianbaez/markdown-bundle
```

## Configuration

This configuration is the default configuration:
```yaml
adrian_baez_markdown:
    options: []
    parser: AdrianBaez\Bundle\MarkdownBundle\MarkdownParser
```
The default parser uses internally [Parsedown][1], but if you want a markdown extra parser change the parser option for `AdrianBaez\Bundle\MarkdownBundle\MarkdownExtraParser` that uses [ParsedownExtra][2].

For MarkdwonParser and MarkdownExtraParser you have the next options available:
```yaml
adrian_baez_markdown:
    options:
        urls_linked: true # Or false
        breaks_enabled: false # Or true
        markup_escaped: false # Or true
        safe_mode: false # Or true
```
The options are related to Parsedown and ParsedownExtra options check the [Parsedown documentation][1] to know more about.  
If you use a custom parser the options keys and values will be restricted only by your parser.

## Usage

- Autowire in your services or controller with the `\AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownInterface` interface.
- Get from the container with the `adrian_baez.markdown` public service.
- Use in Twig templates with the `markdown` filter.

All the versions above uses de default configuration, but you can pass a second parameter (optional parameter in twig filter) for a individual case, this parameter must be an array with the accepted options keys and values that will be merged with the defaults.

The service can be invoked directlly or with the `parse` method:
```php
<?php

$markdown('Text to parse');
$markdown->parse('Text to parse');

// In controller

($this->get('adrian_baez.markdown'))('Text to parse');
$this->get('adrian_baez.markdown')->parse('Text to parse');

// Modify default behavior with the second parameter

$markdown('http://example.com', ['urls_linked' => false]);
```

## Examples:

### Autowire in your services or controllers:

```php
<?php

namespace App\Controller;

use AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyController extends Controller
{
    /**
     * @param  MarkdownInterface $markdown
     * @return Response
     */
    public function myAction(MarkdownInterface $markdown)
    {
        return new Response($markdown('my text to parse'));
    }
}
```

### Get the service from container

```php
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyController extends Controller
{
    /**
     * @return Response
     */
    public function myAction()
    {
        return new Response(($this->get('adrian_baez.markdown'))('my text to parse'));
    }
}
```
### In twig templates

```twig
{# Literal string #}
{{ 'Text to parse'|markdown }}

{# variable #}
{{ myMdText|markdown }}

{# variable and options variable #}
{{ myMdText|markdown(options) }}

{# variable and inline options #}
{{ myMdText|markdown({urls_linked: false}) }}
```

## Advanced

If you want to use a custom markdown parser you need to create a class that implements de `AdrianBaez\Bundle\MarkdownBundle\Interfaces\MarkdownParserInterface` interface.
If the class has a constructor, it must not receive parameters.

The interface has two methods:

`parse` wich receives a string and returns a string.  
This method is the responsible for calling your parser and return the parsed HTML.
```php
<?php

public function parse(string $text) :string;

```
`setOptions` wich receives an array, returns a MarkdownParserInterface instance and throws a RuntimeException if the options can't be setted.  
This method is the responsible for setting your parser options from the array received from the bundle configuration.
```php
<?php

public function setOptions(array $options) :MarkdownParserInterface;

```
Check the [MarkdownParser class][3] to better understand

[1]: https://github.com/erusev/parsedown
[2]: https://github.com/erusev/parsedown-extra
[3]: https://github.com/adrianbaez/markdown-bundle/blob/master/src/MarkdownParser.php
