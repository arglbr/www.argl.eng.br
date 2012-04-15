<?php
require (CONTROLLERS_DIR . 'web_controller.php');

class MozillaBrowserID extends WebController
{
    public function getIndex()
    {
        print 'OooOooOoooppsss... something wrong here!';
    }

    public function postTriggerAuth()
    {
        $lang   = $this->getLang();
        $output = $this->doPostRequest('https://browserid.org/verify',
                                       array('assertion' => $_POST['hid_value1'],
                                             'audience'  => $_SERVER['SERVER_NAME']));

        $tpl    = $this->twig->loadTemplate('garage' . DIR_SEP . "mbid_reply_$lang.tpl");
        print $tpl->render(array('lang'     => $lang,
                                 'ret_str'  => $output,
                                 'foursq'   => $this->getLast4sqCheckin(),
                                 'identica' => $this->getLastMicroblogEntry(),
                                )
                          );
        unset($lang, $tpl);
    }

    public function getSessKill($p_matches)
    {
        $this->unsetSession();
        header("Location: /");
    }
}

