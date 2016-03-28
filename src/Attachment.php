<?php
namespace Simplia\Mailgun;

class Attachment {

    /**
     * @var string
     */
    protected $name, $url;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Attachment
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Attachment
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }
}
