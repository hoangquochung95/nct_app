<?php
use Illuminate\Support\Facades\DB as DB;

class Helpers
{
    private static $seen = array();

    public static function getWebInfo($url,$deep)
    {
        self::crawlerWeb($url,$deep);
        return self::$seen;
    }

    public static function crawlerWeb($url, $depth = 5)
    {
        if (count(self::$seen) <= 500) {

            $isUrlExists = DB::table('media_items')->where('url', $url)->exists();
            if (!$isUrlExists) {
                if (isset(self::$seen[$url]) || $depth === 0 || $isUrlExists) {
                    return;
                }
                self::$seen[$url] = true;
                $dom = new DOMDocument();
                @$dom->loadHTMLFile($url);

                self::handleData($url, $dom);

                $anchors = $dom->getElementsByTagName('a');

                foreach ($anchors as $element) {
                    $href = $element->getAttribute('href');
                    $href = self::handleUrl($url, $href);
                    self::crawlerWeb($href, $depth - 1);
                }
            }
        }
    }

    public static function handleUrl($url, $href)
    {
        $href = ltrim($href, '\\');
        $href = trim($href, '"');
        $href = trim($href);
        if (
            strpos($href, 'http') === false &&
            strpos($href, 'https') === false
        ) {
            $path = '/' . ltrim($href, '/');

            $parts = parse_url($url);

            $href = $parts['scheme'] . '://';
            if (isset($parts['user']) && isset($parts['pass'])) {
                $href .= $parts['user'] . ':' . $parts['pass'] . '@';
            }
            $href .= $parts['host'];

            if (isset($parts['port'])) {
                $href .= ':' . $parts['port'];
            }
            if (isset($parts['path'])) {
                $href .= dirname($parts['path'], 1) . $path;
            }
        } else {
            $parts = parse_url($href);
            if (strpos($parts['host'], 'nhaccuatui') === false) {
                $href = '';
            }
        }
        if (!curl_init($href))
            $href = '';

        return $href;
    }

    public static function handleData($url, $dom)
    {
        $parts = parse_url($url);
        $boxPlayElement = $dom->getElementById('box_playing_id');
        $id = '';
        if (isset($parts['path']) && !empty($boxPlayElement)) {
            $type = dirname($parts['path'], 1);
            switch ($type) {
                case '/bai-hat':
                    $id = self::addBaiHat($dom, $url, 'audio');
                    break;
                case '/playlist':
                    $id = self::addPlaylist($dom, $url);
            }
        }
        return $id;
    }
    public static function addPlaylist($dom, $url)
    {

        $isPlaylistUrlExists = DB::table('playlist_items')->where('url', $url)->exists();
        if (!$isPlaylistUrlExists) {
            $name = self::getData($dom, 'h1', 'itemprop', 'name')->nodeValue;
            $imageTag = self::getData($dom, 'meta', 'property', 'og:image');
            $image = !empty($imageTag) ? $imageTag->getAttribute('content') : '';
            $artists = '';
            $listSong = self::getData($dom, 'ul', 'class', 'list_song_in_album');
            $mediaIds = array();

            foreach ($listSong->getElementsByTagName('a') as $song) {
                if ($song->getAttribute('class') === 'name_singer' && strpos($artists, $song->nodeValue) === false) {
                    $artists .= ' ,' . $song->nodeValue;
                }
                @$dom->loadHTMLFile($song->getAttribute('href'));
                $id = self::handleData($song->getAttribute('href'), $dom);

                if (!empty($id))
                    $mediaIds[] = $id;
            }
            $artists = ltrim($artists, ' ,');

            $data = array(
                'name' => $name,
                'artists' => $artists,
                'image' =>  $image,
                'url' => $url,
                'medias' => json_encode($mediaIds)
            );
            return DB::table('playlist_items')->insertGetId( $data );
        }
    }
    
    public static function addBaiHat($dom, $url, $type)
    {
        $isUrlExists = DB::table('media_items')->where('url', $url)->exists();
        if (!$isUrlExists) {
            $title = self::getData($dom, 'h1', 'itemprop', 'name')->nodeValue;
            $artistsTag = self::getData($dom, 'h2', 'class', 'name-singer');
            $imageTag = self::getData($dom, 'meta', 'property', 'og:image');
            $image = !empty($imageTag) ? $imageTag->getAttribute('content') : '';

            $data = array(
                'type' => $type,
                'title' => $title,
                'artists' => $artistsTag->nodeValue,
                'url' => $url,
                'image' =>  $image
            );

            return DB::table('media_items')->insertGetId($data);
        }
    }
    public static function getData($dom, $tag, $attribute, $attributeReq)
    {
        $elements = $dom->getElementsByTagName($tag);
        foreach ($elements as $element) {
            if ($element->hasAttribute($attribute) && $element->getAttribute($attribute) == $attributeReq) {
                return $element;
            }
        }
    }
    public function separateCategory($url)
    { }
}
