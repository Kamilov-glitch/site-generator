<?php

class Renderer
{
    /**
     * @param array $content
     * @return void
     */
    function render(array $content): void
    {
        $this->listFolderFiles("../" . __DIR__);
    }

     //to list folder and its content

    /**
     * @param $dir
     * @return void
     */
    function listFolderFiles($dir){
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