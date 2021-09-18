<?php
/**
 * Created by PhpStorm.
 * User: SAIEF
 * Date: 9/7/2018
 * Time: 8:12 PM
 */

namespace MikrotikAPI\Commands\Queues;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;
/**
 * Description of Mapi_Queue_Simple
 *
 * @author      Lalu Erfandi Maula Yusnu info@asmsaief.com <http://asmsaief.com>
 * @copyright   Copyright (c) 2018, One Uproar.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Simple
{
    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar){
        $this->roar = $roar;
    }

    /**
     * This method is used to add queues simple
     * @param type $param array
     * @return type array
     *
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }




    /**
     * This method is used to disable queues simple
     * @param type $id string
     * @return type array
     *
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/disable");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to enable queues simple
     * @param type $id string
     * @return type array
     *
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/enable");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit queues simple
     * @param type $param array
     * @param type $id string
     * @return type array
     *
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to delete queues simple
     * @param type $id string
     * @return type array
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/remove");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all queues simple
     * @return type array
     *
     */

    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/getall");
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
     * This method is used to display one queues simple
     * in detail based on the id
     * @param type $id not array
     * @return type array
     *
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/print");
        $sentence->where("name", "=", $id);
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

    /**
     * This method is used to display one queues simple
     * in detail based on the name
     * @param type $name not array
     * @return type array
     *
     */
    public function detailByName($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/print");
        $sentence->where("name", "=", $name);
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

    /**
     * This method is used to display one queues simple
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/print");
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