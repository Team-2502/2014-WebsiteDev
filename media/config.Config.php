<?php


/** 
 * Config File
 * 
 * This file stores all of the configuration 
 * settings for the gallery.
 * 
 * @author Eric Eastwood (MLM) <me@ericeastwood.com> 
 * @copyright 2013 Eric Eastwood
 */  
class Config {

    public static $config = array(
        'core' => array(
            'scripturl' => 'http://team2502.com/media/',
        ),
        'filesystem' => array(
            'dir' => '/media/gallery/',
            'salt' => 'QphUs7Zuh3'
        ),
        'gallery' => array(
            'itemsperpage' => 30,
            'supportedtypes' => array(
                'image/jpeg',
                'image/png',
                'image/gif',
                'video/youtube',
            ),
            'supportedexts' => array(
                'jpg',
                'jpeg',
                'gif',
                'png',
            ),
        ),
        'db' => array(
            'host' 			=> 'db492496516.db.1and1.com',
            'username' 	    => 'dbo492496516',
            'password'  	=> 'wRvPDDFP7JpSqzQ',
            'dbname' 		=> 'db492496516',
        ),
	);


    public static $mime_to_extension = array(
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',

    );
}



?>