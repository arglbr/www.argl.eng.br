<?php
require (CONTROLLERS_DIR . 'web_controller.php');

class Garage extends WebController
{
    private $garage_views;

    public function __construct()
    {
        parent::__construct();
        $this->garage_views = 'garage' . DIR_SEP;
    }

    private function getProjects()
    {
        $lang           = $this->getLang();
        $proj1          = new StdClass();
        $proj1->tplname = $this->garage_views . "mbid_home_$lang.tpl";
        unset($lang);
        return array($proj1);
    }

    public function getIndex()
    {
        $lang = $this->getLang();
        $tpl  = $this->twig->loadTemplate($this->garage_views . "index_$lang.tpl");
        print $tpl->render(array('lang'     => $lang,
                                 'foursq'   => $this->getLast4sqCheckin(),
                                 'projects' => $this->getProjects(),
                                 'identica' => $this->getLastMicroblogEntry(),
                                )
                          );
        unset($lang);
    }
}
