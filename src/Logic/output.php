<?php

require_once "./Parser.php";

require_once "./Renderer.php";

$parser = new Parser();
$renderer = new Renderer();

$markdown = file_get_contents('../Sites/example/example.md');
$content = $parser->parseMarkdown($markdown);

$renderer->render($content);

