<?php

namespace App\Http;


use Illuminate\Support\Facades\Session;

class FileManager
{

    /**
     * @var $ownerId
     */
    var $ownerId;

    /**
     * @var $ownerClassName
     */
    var $ownerClassName;

    public static $LIST_VIEW = 'list';
    public static $THUMBS_VIEW = 'thumbs';
    /**
     * @var String $viewType
     */
    var $viewType;

    /**
     * @var $sessionKey
     */
    var $sessionKey;

    /**
     * @var $mediaCollectionName
     */
    var $mediaCollectionName;

    /**
     * @var $ownerName
     */
    var $ownerName;


    /**
     * @param string $classNameWithNS
     * @param $id
     * @param $mediaCollectionName
     * @return string
     */
    public static function getSessionKeyName(string $classNameWithNS, $id, $mediaCollectionName){
        return md5($classNameWithNS.'-'.$mediaCollectionName.'-'.$id);
    }


    /**
     * @param $classNameWithNS
     * @param $id
     * @param $mediaCollectionName
     * @return FileManager
     */
    public static function createInSession($classNameWithNS, $id, $mediaCollectionName){
        $fm = new FileManager();
        $fm->ownerClassName = $classNameWithNS;
        $fm->ownerId = $id;
        $fm->mediaCollectionName = $mediaCollectionName;
        $fm->viewType = 'list';
        $key = FileManager::getSessionKeyName($classNameWithNS, $id, $mediaCollectionName);
        $fm->sessionKey = $key;
        Session::put($key, $fm);
        return $fm;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function loadFromSession($key){
        return Session::get($key);
    }

    /**
     * @param $bytes
     * @return string
     */
    public static function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576){
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024){
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1){
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1){
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }

}
