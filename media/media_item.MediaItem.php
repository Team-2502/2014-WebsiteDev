<?php
//print_r(PDO::getAvailableDrivers());  

include_once('config.Config.php');


class MediaItem {

    private $id;
    private $slug;

    public function __construct($id, $slug) {
        $this->id = $id;
        $this->slug = $slug;
    }

    public function getInfo()
    {
        // We only want to show something if the slug is set
        if(isset($this->id) && isset($this->slug))
        {
            $db = new PDO('mysql:host='. Config::$config['db']['host'] .';dbname='. Config::$config['db']['dbname'], Config::$config['db']['username'], Config::$config['db']['password']);
            $query = $db->prepare("SELECT * FROM `media_item` WHERE `id` = :id && `slug` = :slug");

            $query->bindValue(':id', $_REQUEST['id'], PDO::PARAM_INT);
            $query->bindValue(':slug', $_REQUEST['slug'], PDO::PARAM_STR);

            $query->execute();

            $media_item = $query->fetch(PDO::FETCH_ASSOC);

            return $media_item;
        }
        else
            return false;
    }

    public function getImage($isInline = true)
    {
        $info = $this->getInfo();

        if($info['type'] == 'image/jpeg' || $info['type'] == 'image/png' || $info['type'] == 'image/gif')
        {
            $attachment_location = $_SERVER['DOCUMENT_ROOT'] . Config::$config['filesystem']['dir'] . $info['folder'] . '/' . $info['id'] . '_' . $info['slug'];

            if (file_exists($attachment_location)) {

                //file_put_contents($info['id'] . '_' . $info['slug'] . '.txt', $attachment_location);


                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                // Cache Stuff Start
                header("Cache-Control: private, max-age=10800, pre-check=10800");
                header("Pragma: private");
                header("Expires: " . date(DATE_RFC822,strtotime(" 2 day")));
                // Cache Stuff End
                header('Content-Type: '. $info['type']);
                header('Content-Transfer-Encoding: Binary');
                header('Content-Length:' . filesize($attachment_location));
                header('Content-Disposition: ', $isInline ? 'inline' : 'attachment' ,' filename=' . $info['slug'] . Config::$mime_to_extension[$info['type']]);
                // image_type_to_mime_type()

                //header('Content-Type: image/jpeg');


                readfile($attachment_location);
                die();
            } else {
                $this->SendErrorImage('Error: File not found: ' . $attachment_location);
            }
        }
        else
            throw new Exception('type is not of image/jpeg|png|gif');
    }

    private function SendErrorImage($note = '')
    {
        $im            = ImageCreateTrueColor(480, 360);
        $text_color    = ImageColorAllocate($im, 233, 14, 91);
        $message_color = ImageColorAllocate($im, 91, 112, 233);

        ImageString($im, 5, 5, 5, "The gallery suffered a problem:", $text_color);
        ImageString($im, 3, 5, 25, $note, $message_color);

        //ImageString($im, 5, 5, 85, "Potentially useful information:", $text_color);

        header("Cache-Control: no-store");
        header('Expires: '.gmdate('D, d M Y H:i:s', time()-1000).' GMT');
        header('Content-Type: image/jpeg');
        ImageJpeg($im);
        ImageDestroy($im);
        exit();
    }

/*
try {  
  # MS SQL Server and Sybase with PDO_DBLIB  
  $DBH = new PDO("mssql:host=$host;dbname=$dbname, $user, $pass");  
  $DBH = new PDO("sybase:host=$host;dbname=$dbname, $user, $pass");  
  
  # MySQL with PDO_MYSQL  
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);  
  
  # SQLite Database  
  $DBH = new PDO("sqlite:my/database/path/database.db");  
}  
catch(PDOException $e) {  
    echo $e->getMessage();  
}  
*/

}

?>