<?php

namespace Formativ\React;

abstract class AbstractComponent
{
  protected $attributes = [];

  protected $supportedAttributes = [
    "accept",
    "accessKey",
    "action",
    "allowFullScreen",
    "allowTransparency",
    "alt",
    "autoCapitalize",
    "autoComplete",
    "autoFocus",
    "autoPlay",
    "cellPadding",
    "cellSpacing",
    "charSet",
    "checked",
    "className",
    "colSpan",
    "content",
    "contentEditable",
    "contextMenu",
    "controls",
    "data",
    "dateTime",
    "dir",
    "disabled",
    "draggable",
    "encType",
    "form",
    "frameBorder",
    "height",
    "hidden",
    "href",
    "htmlFor",
    "httpEquiv",
    "icon",
    "id",
    "label",
    "lang",
    "list",
    "loop",
    "max",
    "maxLength",
    "method",
    "min",
    "multiple",
    "name",
    "pattern",
    "placeholder",
    "poster",
    "preload",
    "radioGroup",
    "readOnly",
    "rel",
    "required",
    "role",
    "rowSpan",
    "scrollLeft",
    "scrollTop",
    "selected",
    "size",
    "spellCheck",
    "src",
    "step",
    "style",
    "tabIndex",
    "target",
    "title",
    "type",
    "value",
    "width",
    "wmode",
    "cx",
    "cy",
    "d",
    "fill",
    "fx",
    "fy",
    "gradientTransform",
    "gradientUnits",
    "offset",
    "points",
    "r",
    "rx",
    "ry",
    "spreadMethod",
    "stopColor",
    "stopOpacity",
    "stroke",
    "strokeLinecap",
    "strokeWidth",
    "transform",
    "version",
    "viewBox",
    "x1",
    "x2",
    "x",
    "y1",
    "y2",
    "y"
  ];

  protected $attributeAliases = [
    "className" => "class",
    "htmlFor"   => "for"
  ];

  protected $children = [];

  protected $tag;

  protected $indent = "  ";

  public function getAttributes()
  {
    return $this->attributes;
  }

  public function getAttributeString()
  {
    $attributes = [];

    foreach ($this->attributes as $key => $value)
    {
      $use = $key;

      if (isset($this->attributeAliases[$key]))
      {
        $use = $this->attributeAliases[$key];
      }

      $attributes[] = $use . "=" . "\"" . addslashes($value) . "\"";
    }

    return join(" ", $attributes);
  }

  public function setAttributes($attributes)
  {
    foreach ($attributes as $key => $value)
    {
      if (in_array($key, $this->supportedAttributes))
      {
        $this->attributes[$key] = $value;
      }
    }
  }

  public function toJavaScript()
  {
    $string = "React.DOM." . ucfirst($this->tag) . "({\n";

    $single = str_repeat($this->indent, 1);
    $double = str_repeat($this->indent, 2);

    $componentStrings = [];
    $attributeLength  = strlen("children");

    if (count($this->attributes))
    {
      $attributes = [];

      foreach ($this->attributes as $key => $value)
      {
        $attributeLength = max(strlen($key), $attributeLength);
        $attributes[$key] = "\"" . addslashes($value) . "\"";
      }

      $attributeStrings = [];

      foreach ($attributes as $key => $value)
      {

        $attributeStrings[] = str_pad($key, $attributeLength) . " : " . $value;
      }

      $componentStrings[] = $single . join(",\n" . $single, $attributeStrings);
    }

    if (count($this->children))
    {
      $children = $single . str_pad("children", $attributeLength) . " : [\n";

      $childStrings = [];

      foreach ($this->children as $child)
      {
        if (is_string($child))
        {
          $childStrings[] = "\"" . $child . "\"";
        }
        else
        {
          $childStrings[] = preg_replace("/\n/", "\n" . $double, $child->toJavaScript());
        }
      }

      $componentStrings[] = $children . $double . join(",\n" . $double, $childStrings) . "\n" . $single . "]";
    }

    return $string . join(",\n", $componentStrings) . "\n})";
  }

  public function toString()
  {
    return ($this . "");
  }

  public function __toString()
  {
    if (empty($this->tag))
    {
      throw new Exception("tag is undefined");
    }

    $string = trim("<" . $this->tag . " " . $this->getAttributeString()) . ">";

    foreach ($this->children as $child)
    {
      $string .= ($child . "");
    }

    return $string . "</" . $this->tag . ">";
  }

  public function __construct($options = [])
  {
    $this->setAttributes($options);

    if (isset($options["children"]))
    {
      $this->children = $options["children"];
    }
  }
}