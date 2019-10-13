<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Hosts
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class HotspotHosts
{

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar)
    {
        $this->roar = $roar;
    }

    /**
     * This method is used to delete hotspot by id
     * @param string $id
     * @return array
     *
     */
    public function delete($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/host/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all hotspot
     * @return type array
     *
     */
    public function getAll()
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/host/getall");
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
     * This method is used to display hotspot host
     * in detail based on the id
     * @param string $id
     * @return type array
     *
     */
    public function detailById($id)
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/host/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            foreach ($rs->getResultArray() as $resust) {
                return $resust;
            }
        } else {
            return false;
        }
    }

    /**
     * This method is used to display hotspot host
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/host/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            $rsArray = $rs->getResultArray();
            foreach ($rsArray as $Id) {
                return $Id['.id'];
            }
        } else {
            return false;
        }
    }

}
