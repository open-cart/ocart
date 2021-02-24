<?php


namespace System\Core\Library;


class PageTitle
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param bool $full
     * @return string
     */
    public function getTitle($full = true)
    {
        if (empty($this->title)) {
            return config('app.name', 'Laravel');
        }

        if (!$full) {
            return $this->title;
        }

        return $this->title . ' | ' . config('app.name', 'Laravel');
    }
}
