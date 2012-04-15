<?php
require_once (LIBS_DIR . 'Twig'  . DIR_SEP . 'lib' . DIR_SEP . 'Twig' . DIR_SEP . 'Autoloader.php');
require_once (LIBS_DIR . 'geoip' . DIR_SEP . 'geoip.inc');
require_once (LIBS_DIR . 'foursquare-php' . DIR_SEP . 'foursquare.php');
// require_once (LIBS_DIR . 'geekli.st-php' . DIR_SEP . 'class.geeklist.php');

abstract class WebController
{
    private static $lang;
    protected $loader;
    protected $twig;

    protected function doGetRequest($p_url)
    {
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $p_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "fetcher " . time()); //prevent rate limit
        $ret = curl_exec($ch);
        curl_close($ch);
        unset($ch);
        return $ret;
    }

    protected function doPostRequest($p_url, $p_params)
    {
        $params_string = '';

        foreach ($p_params as $name => $value) {
            $params_string .= $name . '=' . $value . '&';
        }

        rtrim($params_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $p_url);
        curl_setopt($ch, CURLOPT_POST, count($p_params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "fetcher " . time());
        $page = curl_exec($ch);
        $ret  = print_r(json_decode($page, true), true);
        curl_close($ch);

        unset($params_string, $ch, $page);
        return $ret;
    }

    protected function unsetSession($p_url, $p_params)
    {
        list($_SESSION, $_POST, $_GET, $_REQUEST) = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }

        session_destroy();
    }

    protected function getLastMicroblogEntry()
    {
        // http://status.net/docs/api/
        $ret = array('id' => null, 'text' => null, 'created_at' => null,);
        $url = 'http://identi.ca/api/statuses/friends_timeline/arglbr.json?count=1';
        $tmp = json_decode($this->doGetRequest($url), true);
        $ret['id']         = $tmp[0]['id'];
        $ret['text']       = $tmp[0]['text'];
        $ret['created_at'] = date('Y-m-d H:i', strtotime($tmp[0]['created_at']));
        unset($url, $tmp);
        return $ret;
    }

    private function getGeekListCards()
    {
        $url  = 'http://geekli.st/arglbr';
        $page = $this->doGetRequest($url);
        $page = stristr($page, '<div class="card-index-box-large">');
        $to   = stripos($page, '<div class="row-box-right-wrapper">');
        $page = strip_tags(substr($page, 0, $to), '<h4>');

        /*
        * - Find the position of each H4 tag;
        * - Get the content of the found H4;
        * - Remove the found part of the string;
        * - Continue as long as there are H4 tags.
        */
        $tagi = '<h4>';
        $tage = '</h4>';

        do {
            $p1    = stripos($page, $tagi);
            $p2    = stripos($page, $tage, $p1);
            $p3    = $p2 - $p1;
            $ret[] = strip_tags(substr($page, $p1, $p3));
            $page  = substr($page, $p2, strlen($page));
        } while ($p1 > 0 || $p2 > 0);

        unset($url, $page, $to, $tagi, $tage, $p1, $p2, $p3);
        return array_filter($ret);
    }

    protected function getRandomGeekListCard()
    {
        // While my API Key do not come...
        $ret = $this->getGeekListCards();
        return $ret[rand(0, (count($ret) - 1))];
    }

    protected function getLast4sqCheckin()
    {
        $fsq             = new FourSquare(getEnv('FOUR_SQ'));
        $ret['name']    = $fsq->venueName;
        $ret['type']    = $fsq->venueType;
        $ret['address'] = $fsq->venueAddress;
        $ret['city']    = $fsq->venueCity;
        $ret['state']   = $fsq->venueState;
        $ret['country'] = $fsq->venueCountry;
        $ret['date']    = date('Y-m-d H:i', strtotime($fsq->date));
        unset($fsq);
        return $ret;
    }

    public function __construct()
    {
        $template_path = VIEWS_DIR;

        if (is_dir($template_path)) {
            Twig_Autoloader::register();
            $this->loader = new \Twig_Loader_Filesystem($template_path);
            $this->twig   = new \Twig_Environment($this->loader, array());
        } else {
            throw new Exception ("Invalid template path ($template_path)");
        }

        if (self::$lang == null) {
            $gi         = geoip_open(LIBS_DIR . 'geoip' . DIR_SEP . 'GeoIP.dat', GEOIP_STANDARD);
            $ip_clean   = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
            self::$lang	= (geoip_country_code_by_addr($gi, $ip_clean) == 'BR') ? 'enus' : 'ptbr';
            unset($gi, $ip_clean);
        }

        unset($template_path);
    }

    public static function getLang()
    {
        return self::$lang;
    }
}
