<?php

namespace MikrotikAPI\Commands\Queues;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of Mapi_Queue
 *
 * @author      Lalu Erfandi Maula Yusnu info@asmsaief.com <http://asmsaief.com>
 * @copyright   Copyright (c) 2018, One Uproar.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Queue {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is use for call class simple
     * @return Object of Simple
     */
    public function simple() {
        return new Simple($this->roar);
    }

}
