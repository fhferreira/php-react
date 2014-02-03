<?php

namespace Formativ\React\Dom;

use Formativ\React\AbstractComponent;
use Formativ\React\ComponentInterface;

class Div
extends AbstractComponent
implements ComponentInterface
{
  protected $tag = "div";
}

function Div($options)
{
  return new Div($options);
}