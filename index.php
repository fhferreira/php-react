<?php

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

print_r($div->toJavaScript());