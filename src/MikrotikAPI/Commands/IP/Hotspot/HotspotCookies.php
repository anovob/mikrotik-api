<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Cookie
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category name
 */
class HotspotCookie {

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to delete hotspot cookie by id
     * @param string $id
     * @return string
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/cookie/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all cookie on hotspot
     * @return array or string
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/cookie/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return false;
        }
    }

    /**
     * This method is used to display hotspot cookie
     * in detail based on the id
     * @param string $id 
     * @return  array
     *  
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/cookie/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            foreach ($rs->getResultArray() as $resust){
                return $resust;
            }
        } else {
            return false;
        }
    }

}
