<?php
namespace IA\Bundle\WebContentThiefBundle\Utils;

class RemoteContent
{
    
    /**
     * Browse URL and return its html content
     * 
     * @param string $url
     * @return string
     */
    function browseUrl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $html = curl_exec($ch);
        curl_close($ch);

        if (!$html) {
            throw new Exception(sprintf("Cannot browse this url: '%s'.", $url));
        }
        
        /*
         * Reencode html text to UTF-8
         */
        $regexCharset = "/(?:<meta[^>]*http-equiv[^>])*charset=(.*?)\"/i";
        if (preg_match($regexCharset, $html, $matches)) {
            $charset = $matches[1];
            if ($charset && ($charset != 'utf-8')) {
                $html = iconv($charset, 'UTF-8', $html);
                $html = preg_replace($regexCharset, 'charset=utf-8"', $html);
            }
        }

        return $html;
    }
}
