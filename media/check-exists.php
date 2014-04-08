<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// The script should return 1 if the file name exists or 0 if the file name does not exist.

/*
// Define a destination
$targetFolder = '/uploads'; // Relative to the root and should match the upload folder in the uploader script


if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
*/


include_once('config.Config.php');

if($_REQUEST['go'] == 'now')
{
    if(checkExists($_FILES['Filedata']['tmp_name']))
        echo 1;
    else
        echo 0;
}

// Returns True if file does not exist
// Otherwise false
function checkExists($filename)
{
    if(isset($filename))
    {
        $db = new PDO('mysql:host=' . Config::$config['db']['host'] . ';dbname=' . Config::$config['db']['dbname'], Config::$config['db']['username'], Config::$config['db']['password']);
        $query = $db->prepare("SELECT * FROM `media_item` WHERE `file_hash` = :hash LIMIT 1");

        $query->bindValue(':hash', md5_file($filename), PDO::PARAM_INT);

        $query->execute();

        if(!($query->rowCount() > 0))
        {
           return true;
        }
        else
        {
            return false;
        }
    }
    else
        return false;
}

?>