<?php
namespace Miaow\Helpers;

/**
 * Media Helper Class
 *
 **/
class MediaHelper
{
    public function __construct()
    {

    }

    /**
     * Get SVG content
     *
     * @param string svg file path
     *
     * @return string svg file content
     **/
    public static function getSVG($pathImage)
    {
        $fileContent = '';
        if (file_exists($pathImage)) {
            $fileContent = file_get_contents($pathImage);
        }
        return $fileContent;
    }

    /**
     * Get formatted filesize
     *
     * @param integer $bytes
     *
     * @return string formatted bytes $bytes
     */
    public static function getFormattedFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' ' . __('bytes', LANG_DOMAIN);
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' ' . __('byte', LANG_DOMAIN);
        } else {
            $bytes = '0 ' . __('byte', LANG_DOMAIN);
        }

        return $bytes;
    }
}
