<?php
function clean_and_return($content, $inner_separator, $item_separator, $format = true)
{
  if ($format)
    $content = format_text($content);
  $items = explode($item_separator, $content);
  foreach ($items as &$item) {
    $item = explode($inner_separator, $item);
    if($format)
      $item[1] = explode("\n", trim($item[1]));
  }
  return $items;
}

function format_text($text)
{
  // Define the regular expression pattern to match text surrounded by asterisks
  $pattern = '/\*(.*?)\*/';
  // Replace the matches with bold HTML tags
  $replacement = '<b>$1</b>';
  // Use preg_replace to perform the replacement
  $text = preg_replace($pattern, $replacement, $text);

  // Define the regular expression pattern to match text surrounded by underscores
  $pattern = '/\_(.*?)\_/';
  // Replace the matches with italic HTML tags
  $replacement = '<i>$1</i>';
  // Use preg_replace to perform the replacement
  $text = preg_replace($pattern, $replacement, $text);

  return $text;
}
