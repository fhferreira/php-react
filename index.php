<?php

require("vendor/autoload.php");

use Formativ\React;

$div1 = new React\DOM\Div();

$div2 = React\DOM\Div([
  "className" => "container",
  "children"  => [
    React\DOM\Div([
      "className" => "row",
      "children"  => [
        React\Dom\Div([
          "className" => "col-md-12",
          "children"  => [
            "Hello World"
          ]
        ])
      ]
    ])
  ]
]);

// print_r($div1->toString());
print_r($div2->toString());