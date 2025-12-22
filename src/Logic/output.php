<?php

require_once "./Parser.php";

require_once "./Renderer.php";

$parser = new Parser();
$renderer = new Renderer();

$markdown = file_get_contents('../Sites/test/home.md');
var_dump($markdown);
echo "<br>";
$content = $parser->parseMarkdown($markdown);

