<?php

// Media
// MLM - VisualPulse.net

error_reporting(E_ALL);

include_once('config.Config.php');


$_GET['action'] = 'media_gallery';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = $txt['media_page_title'];

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);



?>

<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/avgrund.css">
<link rel="stylesheet" href="css/focal-point.css">
<link rel="stylesheet" href="css/uploadify.css">

<script>document.cookie = 'resolution=' + Math.round(Math.max(screen.width, screen.height) / 5) + ("devicePixelRatio" in window ? "," + devicePixelRatio : ",1") + '; path=/';</script>
<script type="text/javascript" src="js/avgrund.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/masonry/2.1.07/jquery.masonry.min.js"></script>
<script src="js/jquery.uploadify.js" type="text/javascript"></script>
<script src="js/jquery.infinitescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.bits.js"></script>



<div id="page-wrap" class="avgrund-contents">



    <?php

    /*
    echo '<pre>';
    print_r($context);
    echo '</pre>';
    */
    // If media moderator or admin you can upload
    $can_upload = in_array(18, $user_info['groups']) || $context['user']['is_admin'];

    // If you are a media moderator then strut your stuff
    if ($can_upload) {
        // Upload new media
        echo '
        <form>
            <div id="queue"></div>
            <input id="file_upload" name="file_upload" type="file" multiple="true">
        </form>
        ';
    }
    ?>


    <?php
    try {
        $db = new PDO('mysql:host=' . Config::$config['db']['host'] . ';dbname=' . Config::$config['db']['dbname'], Config::$config['db']['username'], Config::$config['db']['password']);
    } catch(PDOException $e)
    {

        die('Could not connect to the database: ' . $e->getMessage());
    }

    // Get last element inserted and approved to see if there is new content
    $query = $db->prepare("SELECT id FROM `media_item` WHERE `state` = 1 ORDER BY `id` DESC LIMIT 1");
    $query->execute();
    $lastInsertedItemArray = $query->fetchAll(PDO::FETCH_ASSOC);
    $lastApprovedInsertID = isset($lastInsertedItemArray[0]['id']) ? $lastInsertedItemArray[0]['id'] : -1;
    //file_put_contents('array.txt', var_export($lastInsertedItemArray, TRUE));


    $numPaginationPages = 0;
    // If new content then update number of pages
    if(!isset($_COOKIE['numItems']) || $_COOKIE['numItems'] < 0 || $_COOKIE['lastApprovedItemID'] != $lastApprovedInsertID)
    {
        //file_put_contents('newcook.txt', 'yea, new cookie');

        $query = $db->prepare("SELECT * FROM `media_item` WHERE `state` = 1");
        $query->execute();

        setCookie('numItems', $query->rowCount());
    }
    //file_put_contents('rows.txt', $_COOKIE['numItems'] . ' : ' . $_COOKIE['lastApprovedItemID'] . '=?' . $lastApprovedInsertID);

    setCookie('lastApprovedItemID', $lastApprovedInsertID);
    ?>

    <div class="pagination">
        <?php
        if(isset($_COOKIE['numItems']))
        {
            for($i = 1; $i <= ceil($_COOKIE['numItems'] / Config::$config['gallery']['itemsperpage']); $i++)
            {
                echo '
                <div class="pagination-link ', (isset($_REQUEST['page']) && $_REQUEST['page'] == $i) ? 'active' : (($i == 1 && !isset($_REQUEST['page'])) ? 'active' : '') ,'">
                    <a href="', Config::$config['core']['scripturl'] ,'?page=', $i ,'">
                        ', $i ,'
                    </a>
                </div>
                ';
            }
        }
        ?>
    </div>


    <div class="container">

        <?php

        $query = $db->prepare("SELECT * FROM `media_item` WHERE `state` = 1 ORDER BY `date_taken` DESC LIMIT :start,:perpage");

        $query->bindValue(':start', ((isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page']-1 : 0) * (isset(Config::$config['gallery']['itemsperpage']) ? Config::$config['gallery']['itemsperpage'] : 30), PDO::PARAM_INT);
        $query->bindValue(':perpage', isset(Config::$config['gallery']['itemsperpage']) ? Config::$config['gallery']['itemsperpage'] : 30, PDO::PARAM_INT);

        $query->execute();

        $media_items = $query->fetchAll(PDO::FETCH_ASSOC);

        //file_put_contents('ewfsdfsa.txt', ((isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page']-1 : 0) * Config::$config['gallery']['itemsperpage'] . ' : ' . Config::$config['gallery']['itemsperpage'] . ' : asdf ' . $_GET['page']);

        /*
        echo '<pre>';
        print_r($media_items);
        echo '</pre>';
        */

        // @param   string    $blockSize    Possible Values: autowidth, large, medium, small -- Check the css for more
        function blockHeader($blockSize = 'autowidth')
        {
            echo '
                <div class="block ', $blockSize, ' masonry-brick focal-point">
                    <div>
                ';
        }

        function blockFooter()
        {
            echo '
                    </div>
                </div>
                ';
        }



        /*
        blockHeader('medium');
        echo '<img src="media/gallery/2013_mar/1_om30.jpg" alt="no description">';
        blockFooter();


        blockHeader('medium');
        echo '<img src="http://visualpulse.net/forums/index.php?action=dlattach;topic=132.0;attach=109;image" alt="no description">';
        blockFooter();
        */

        foreach ($media_items as $key => $item) {
            if (in_array($item['type'], Config::$config['gallery']['supportedtypes'])) {

                if ($item['type'] == 'image/jpeg' || $item['type'] == 'image/png' || $item['type'] == 'image/gif') {
                    blockHeader('image medium');
                    echo '<img src="', Config::$config['core']['scripturl'], 'getmedia.php?id=', $item['id'], '&slug=', $item['slug'], '" alt="no description">';


                    echo '
                    <div class="popup_contents">
                    <img src="', Config::$config['core']['scripturl'], 'getmedia.php?id=', $item['id'], '&slug=', $item['slug'], '&noadaptive=true" alt="no description">
                    </div>
                    ';
                    blockFooter();
                } elseif ($item['type'] == 'video/youtube') {
                    blockHeader('youtube autowidth');

                    echo '<img src="http://img.youtube.com/vi/', $item['folder'], '/hqdefault.jpg" alt="no description">';

                    echo '
                    <div class="popup_contents">
                        <iframe id="popup-youtube-player" width="640" height="360" src="http://www.youtube.com/embed/', $item['folder'], '?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen="true" allowscriptaccess="always"></iframe>
                    </div>
                    ';
                    blockFooter();
                }

            }

        }

        ?>

    </div>


</div>


<aside id="default-popup" class="avgrund-popup">

    <div class="avgrund-popup-content">

        <h1>Image Here</h1>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum.
        </p>

    </div>

</aside>

<div class="avgrund-cover"></div>

<script type="text/javascript">
    <?php
    $timestamp = time();

    $extString = '';
    foreach(Config::$config['gallery']['supportedexts'] as $key => $value)
        $extString .= '*.' . $value . (($key != (count(Config::$config['gallery']['supportedexts'])-1)) ? '; ' : '');


    $maxUpload = getBytes(ini_get('upload_max_filesize')); // can only be set in php.ini and not by ini_set()
    $maxPost = getBytes(ini_get('post_max_size'));         // can only be set in php.ini and not by ini_set()
    $memoryLimit = getBytes(ini_get('memory_limit'));
    $limit = min($maxUpload, $maxPost, $memoryLimit);


    function getBytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val) - 1]);
		switch ($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}
		return $val;
	}

    function formatBytes($size, $precision = 2)
    {
        $base = log($size) / log(1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)] . 'B';
    }



    ?>


    $(function() {
        $('#file_upload').uploadify({
            //'debug' : true,
            //'removeCompleted' : false,
            'fileSizeLimit' : '<?php echo formatBytes($limit); ?>',
            'fileTypeDesc' : 'Image Files',
            'fileTypeExts' : '<?php echo $extString; ?>',
            'formData'     : {
                'timestamp' : '<?php echo $timestamp; ?>',
                'token'     : '<?php echo md5(Config::$config['filesystem']['salt'] . $timestamp); ?>'
            },
            'checkExisting' : 'check-exists.php?go=now',
            'swf'      : 'uploadify.swf',
            'uploader' : 'uploadify.php'

        });
    });
</script>



<?php
// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>