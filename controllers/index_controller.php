<?php
require (CONTROLLERS_DIR . 'web_controller.php');

class Index extends WebController
{
    private function getLastBlogPost()
    {
        $host     = getenv('DB_HOST');
        $dbname   = getenv('DB_NAME');
        $user     = getenv('DB_USER');
        $password = getenv('DB_PASS');
        $dsn      = "mysql:dbname=$dbname;host=$host";
        $lang     = $this->getLang();
        $table    = ($lang == 'ptbr') ? 'wp_pt_posts' : 'wp_en_posts';
        $sql      = "SELECT post_title title,
                            post_name url,
                            post_content content
                     FROM $table
                     WHERE post_status = 'publish'
                     ORDER BY post_date DESC LIMIT 1;";

        try {
            $dbh            = new PDO($dsn, $user, $password);
            $sth            = $dbh->prepare($sql);
            $sth->execute();
            $res            = $sth->fetch(PDO::FETCH_ASSOC);
            $ret['title']   = strip_tags($res['title'], '<p><a><br/>');
            $ret['url']     = strip_tags($res['url'], '<p><a><br/>');
            $ret['content'] = substr(strip_tags($res['content'], '<p><a><br/>'), 0, 300) . '...';

        } catch (PDOException $e) {
            $ret = array('title' => null, 'url' => null, 'content' => null);
        }

        unset($dbh, $dbname, $dsn, $host, $lang, $password, $res, $sql,
              $sth, $table, $user);
        return $ret;
    }

    public function getIndex()
    {
        $lang     = $this->getLang();
        $blogdata = $this->getLastBlogPost();
        $template = $this->twig->loadTemplate('index' . DIR_SEP . "index_$lang.tpl");
        $identica = $this->getLastMicroblogEntry();

        print $template->render(array('lang' => $lang,
                                      'blog' => $blogdata,
                                      'foursq' => $this->getLast4sqCheckin(),
                                      'gl_card' => $this->getRandomGeekListCard(),
                                      'identica' => $identica));
        unset($lang, $blogdata, $template, $identica);
    }
}
