<?php

class Parser
{
    /**
     * @param string $markdown
     * @return string[]
     */
    function parseMarkdown(string $markdown): array {
        return $this->getComponentNames($markdown);
    }

    /**
     * @param $markdown
     * @return string[]
     */
    function getComponentNames(&$markdown): array {
        $markdown = preg_replace("/\s+/", "", $markdown);
        $components = [];
        while (str_contains($markdown, '{{') && str_contains($markdown, '}}')) {
            $components[] = $this->getComponentName($markdown);
        }

        var_dump($components);

        return $components;
    }

    /**
     * @param $markdown
     * @return string
     */
    function getComponentName(&$markdown): string {
        echo "markdown at start: " . $markdown;
        echo "<br>";
        $bracketStart = strpos($markdown, '{');
        $bracketEnd = strpos($markdown, "}");
        echo 'brackerStart: ' . $bracketStart;
        echo "<br>";
        echo 'brackerEnd: ' . $bracketEnd;
        echo "<br>";

        $component = substr($markdown, $bracketStart + 2, $bracketEnd - 2);

        echo 'component: ' . $component;

        echo "<br>";

        $componentLength = strlen($component);

        echo "<br>";

        echo 'len: ' . $componentLength;

        $markdown = substr_replace($markdown, '', $bracketStart, $componentLength + 4);

        echo "<br>";

        echo 'markdown at end: ' . $markdown;
        echo "<br>";

        return $component;
    }
}