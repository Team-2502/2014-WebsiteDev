<?php

include_once('config.Config.php');
include_once('media_item.MediaItem.php');

if(isset($_REQUEST['id']) && isset($_REQUEST['slug']))
{
    $item = new MediaItem($_REQUEST['id'], $_REQUEST['slug']);
    $info = $item->getInfo();

    /*
    echo '<pre>';
    print_r($info);
    echo '</pre>';
    */

    try
    {
        if($info['type'] == 'image/jpeg' || $info['type'] == 'image/png' || $info['type'] == 'image/gif')
            $item->getImage();
    }
    catch(Exception $e)
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}


    /*
    echo '
    <img src="', Config::$config['core']['scripturl'] . Config::$config['filesystem']['dir'] . $info['folder'] . '/' . $info['id'] . '_' . $info['slug']   ,'" alt="">
    ';
    */



?>