<?php

namespace Ocart\Core\Supports;

class EmailHandler
{
    protected $mail;

    protected $preview = false;

    public function setModule()
    {

    }

    public function create($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function preview()
    {
        $this->preview = true;

        return $this;
    }

    public function sendUsingTemplate($template, $data = [])
    {
        $mailable = new EmailAbtrast($data);
        $mailable->markdown($template, $data);

        if ($this->preview) {
            return $mailable;
        }

        if (setting('using_queue_to_send_mail')) {
            $this->mail->queue($mailable);
        } else {
            $this->mail->send($mailable);
        }
    }
}