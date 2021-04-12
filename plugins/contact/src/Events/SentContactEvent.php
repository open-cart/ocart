<?php

namespace Ocart\Contact\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Ocart\Core\Events\Event;
use stdClass;

class SentContactEvent extends Event
{
    use SerializesModels;

    /**
     * @var Model|false
     */
    public $data;

    /**
     * SentContactEvent constructor.
     * @param Model|false|stdClass $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
}
