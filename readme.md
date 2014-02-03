PHP ReactJS
===========

Because I thought it would be fun to try. And it was.

Usage
-----

```php
require("vendor/autoload.php");

use Formativ\React;

$div = React\Dom\Div([
  "className" => "foo",
  "children"  => [
    React\Dom\Div([
      "children" => [
        "Hello"
      ]
    ]),
    React\Dom\Div([
      "children" => [
        "World",
        "!"
      ]
    ])
  ]
]);

$div->toString();
$div->toJavaScript();
```

The `toString()` method will generate:

```html
<div class="foo"><div>Hello</div><div>World!</div></div>
```

The `toJavaScript()` method will generate:

```js
React.DOM.Div({
  className : "foo",
  children  : [
    React.DOM.Div({
      children : [
        "Hello"
      ]
    }),
    React.DOM.Div({
      children : [
        "World",
        "!"
      ]
    })
  ]
})
```