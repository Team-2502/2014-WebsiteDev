<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

include_once('config.Config.php');
include_once('check-exists.php');

require('../forums/SSI.php');

//file_put_contents('ssss.txt', 'still working');

// Define a destination
$targetFolder = Config::$config['filesystem']['dir']; // Relative to the root

$verifyToken = md5(Config::$config['filesystem']['salt'] . $_POST['timestamp']);

$jsonData = array(
    'success' => false,
    'message' => '',
    'errors' => array(),
);


if (!empty($_FILES) && $_POST['token'] == $verifyToken)
{


    if(checkExists($_FILES['Filedata']['tmp_name']))
    {
        //file_put_contents('ex.txt', 'doesnt exist so upload');



        $slug = generateRandomString(4);

        // Assume the taken and submitting member are the same for now...
        $takenMemberID = $context['user']['id'];
        $submittedMemberID = $context['user']['id'];

        $targetPathSubFolder = strtolower(date('Y_M'));
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder . $targetPathSubFolder;
        $targetFile = rtrim($targetPath,'/');
        //file_put_contents('ttt.txt', $targetFile);

        $fileParts = pathinfo($_FILES['Filedata']['name']);

        // Sanitize file type to only allowed file types before saving
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['Filedata']['tmp_name']);
        finfo_close($finfo);
        //file_put_contents('ffff.txt', $mime_type . ' : ' . $fileParts['filename'] . '.' . $fileParts['extension']);

        // Check extension and the mime type
        if (in_array(strtolower($fileParts['extension']), Config::$config['gallery']['supportedexts']) && (in_array($mime_type, Config::$config['gallery']['supportedtypes'])))
        {
            $db = new PDO('mysql:host=' . Config::$config['db']['host'] . ';dbname=' . Config::$config['db']['dbname'], Config::$config['db']['username'], Config::$config['db']['password']);
            

            try
            {
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->beginTransaction();


                $query = $db->prepare("
                    INSERT INTO `media_item` (
                        `slug`,
                        `folder`,
                        `type`,
                        `date_taken`,
                        `date_submitted`,
                        `taken_member_id`,
                        `submitted_member_id`,
                        `state`,
                        `file_hash`
                    ) VALUES (
                        :slug,
                        :folder,
                        :type,
                        :date_taken,
                        :date_submitted,
                        :taken_member_id,
                        :submitted_member_id,
                        :state,
                        :file_hash
                    )
                ");

                $query->bindValue(':slug', $slug, PDO::PARAM_STR);
                $query->bindValue(':folder', $targetPathSubFolder, PDO::PARAM_STR);
                $query->bindValue(':type', $mime_type, PDO::PARAM_STR);

                $exif = exif_read_data($_FILES['Filedata']['tmp_name'], 'EXIF');
                $date_taken = DateTime::createFromFormat('Y:m:d H:i:s', $exif['DateTimeOriginal'])->getTimestamp();
                //file_put_contents('eeeee.txt',  $date_taken . 'asdf');
                
                $query->bindValue(':date_taken', $date_taken, PDO::PARAM_STR);
                $query->bindValue(':date_submitted', time(), PDO::PARAM_STR);

                $query->bindValue(':taken_member_id', $takenMemberID, PDO::PARAM_INT);
                $query->bindValue(':submitted_member_id', $submittedMemberID, PDO::PARAM_INT);

                $query->bindValue(':state', 0, PDO::PARAM_INT);
                $query->bindValue(':file_hash', md5_file($_FILES['Filedata']['tmp_name']), PDO::PARAM_STR);

                $query->execute();

                //file_put_contents('exec.txt', 'asdf');


                $upload_id = $db->lastInsertId();


                // Make the directory if it doesn't exist
                $made_dir = true;
                if (!is_dir($targetFile)) {
                    $made_dir = mkdir($targetFile, 0755, true);
                    if(!$made_dir) {
                        file_put_contents('makdirFAIL.txt', $targetFile . ' - ' . ($made_dir ? 't' : 'f'));
                    }
                }
                

                // Only if the directory is made should we move it there
                if($made_dir)
                {
                    move_uploaded_file($tempFile, $targetFile . '/' . $upload_id . '_' . $slug);
                    $db->commit();
                    //file_put_contents('commit.txt', 'asdf');
                    echo '1';

                }
                else
                {
                    // File was not moved do not save!
                    $db->rollBack();
                    //file_put_contents('rollback.txt', 'asdf');
                    echo '0';
                }
            }
            catch(PDOException $e)
            {
                file_put_contents('o no.txt', 'db fail');
                $db->rollBack();
                echo '0';

            }
        } else {
            echo 'Invalid file type.';
        }
    }
    else {
        //file_put_contents('ex.txt', 'File already exists on server');
        echo 'File already exists on server.';
        //file_put_contents('alreadyexists.txt', 'asdf');
    }
}


function generateRandomString($length = 10) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

?>