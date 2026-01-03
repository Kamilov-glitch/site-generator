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
    /**
     * @param $line
     * @return array|mixed|string|string[]
     */
    function parseLine($line) {
        $parsedLine = $line;
        if (str_starts_with($parsedLine, "####")) {
            $parsedLine = preg_replace("/#+/", "<h4>", $parsedLine) . "</h4>";

            echo "pasedLine: ";
            var_dump($parsedLine);
            echo "<br>";
        } elseif (str_starts_with($parsedLine, "###")) {
            $parsedLine = preg_replace("/#+/", "<h3>", $parsedLine) . "</h3>";

            echo "pasedLine: ";
            var_dump($parsedLine);
            echo "<br>";
        } elseif (str_starts_with($parsedLine, "##")) {
            $parsedLine = preg_replace("/#+/", "<h2>", $parsedLine) . "</h2>";

            echo "pasedLine: ";
            var_dump($parsedLine);
            echo "<br>";
        } elseif (str_starts_with($parsedLine, "#")) {
            $parsedLine = preg_replace("/#+/", "<h1>", $parsedLine) . "</h1>";

            echo "pasedLine: ";
            var_dump($parsedLine);
            echo "<br>";
        } elseif (str_starts_with($parsedLine, "- ")) {
            $parsedLine = preg_replace("/- /", "<li>", $parsedLine) . "</li>";

            echo "pasedLine: ";
            var_dump($parsedLine);
            echo "<br>";
        }

        if (str_contains($parsedLine, "**")) {
            $parsedLine = $this->replaceAllOccurences($parsedLine, "**", "strong");

            echo "STRONG: ";
            var_dump($parsedLine);
            echo "<br>";
        }

        if (str_contains($parsedLine, "*")) {
            echo "Italic: ";
            var_dump($parsedLine);
            echo "<br>";

            $parsedLine = $this->replaceAllOccurences($parsedLine, "*", "i");
        }

        return $parsedLine;
    }

    // not using strrpos, cause there might be multiple (more than 2) instances of the needle we're looking for

    /**
     * @param $haystack
     * @param $needle
     * @param $htmlElement
     * @return string
     */
    function locateReplacement($haystack, $needle, $htmlElement) {
        $needleLen = strlen($needle);
        $startPos = strpos($haystack, $needle);
        $offset = $startPos + $needleLen;
        $endPos = strpos($haystack, $needle, $offset);

        $locatedStringLen = $endPos - $offset;

        $locatedString = substr($haystack, $offset, $locatedStringLen);

        return "<$htmlElement>" . $locatedString . "</$htmlElement>";
    }

    /**
     * @param $haystack
     * @param $needle
     * @param $htmlElement
     * @return array|string|string[]|null
     */
    function replaceAllOccurences($haystack, $needle, $htmlElement) {
        $parsedHaystack = $haystack;

        while (str_contains($parsedHaystack, $needle)) {
            $replacement = $this->locateReplacement($parsedHaystack, $needle, $htmlElement);

            echo "<br>";
            var_dump($replacement);
            echo "<br>";

            $parsedHaystack = preg_replace(
                $needle . "/.*?/" . $needle,
                $replacement,
                $parsedHaystack,
                1
            );
        }

        return $parsedHaystack;
    }
}