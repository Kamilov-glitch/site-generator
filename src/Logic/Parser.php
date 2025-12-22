<?php

class Parser
{
    /**
     * @param string $markdown
     * @return string[]
     */
    function parseMarkdown(string $markdown): array {
        // TODO: for future, when I'll be having components made with markdowns
         return $this->getComponentNames($markdown);
    }

    /**
     * @param $markdown
     * @return string[]
     */
    function getComponentNames($markdown): array {
        $lines = explode(PHP_EOL, $markdown);
        $components = [];
        foreach ($lines as $line) {
            $this->parseLine($line);
        }

//        var_dump($components);

        return $components;
    }

    // TODO: make sure it only removes the # at the begining of the line, cause could be a case with header being "#"
    // TODO: gotta make sure "p" that are on multiple lines do render properly - I think if I just turn the one empty space to "\n" it should be fine
    function parseLine($line) {
        if (str_starts_with($line, "####")) {
            $parsedLine = preg_replace("/#+/", "<h4>", $line);

            var_dump($parsedLine);
        }
    }
}