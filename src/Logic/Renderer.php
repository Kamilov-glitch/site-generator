<?php

class Renderer
{
    const ROOT_FOLDER = "/var/www/html";
    const COMPONENT_FOLDER = self::ROOT_FOLDER . "/Sites/example/components";

    /**
     * @param array $content
     * @return void
     */
    function render(array $content): void
    {
        echo "<br>";
        echo __DIR__;
        echo "<br>";
        $this->listFolderFiles(self::COMPONENT_FOLDER);
    }

     //to list folder and its content

    /**
     * @param $dir
     * @return void
     */
    function listFolderFiles($dir): void
    {
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        // prevent empty ordered elements
        if (count($ffs) < 1)
            return;

        echo '<ol>';
        foreach($ffs as $ff){
            echo '<li>'.$ff;
            if(is_dir($dir.'/'.$ff)) $this->listFolderFiles($dir . '/' . $ff);
            echo '</li>';
        }
        echo '</ol>';
    }
}