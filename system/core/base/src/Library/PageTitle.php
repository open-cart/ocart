<?php


namespace Ocart\Core\Library;


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
            return $this->defaultTitle();
        }

        if (!$full) {
            return $this->title;
        }

        return $this->title . ' | ' . $this->defaultTitle();
    }

    public function defaultTitle(){
        return setting('admin_title', config('app.name', 'Laravel'));
    }
}
