<?php
namespace Simplia\Mailgun;

class Message {
    protected $id;
    protected $bodyHtml;
    protected $bodyPlain;
    protected $strippedHtml;
    protected $replyTo;
    protected $fromName;
    protected $fromEmail;

    /**
     * @return mixed
     */
    public function getFromEmail() {
        return $this->fromEmail;
    }

    /**
     * @param mixed $fromEmail
     * @return Message
     */
    public function setFromEmail($fromEmail) {
        $this->fromEmail = $fromEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFromName() {
        return $this->fromName;
    }

    /**
     * @param mixed $fromName
     * @return Message
     */
    public function setFromName($fromName) {
        $this->fromName = $fromName;
        return $this;
    }

    /**
     * @var \DateTime
     */
    protected $date;
    protected $subject;
    protected $threadIndex;
    /**
     * @var bool
     */
    protected $spam;
    /**
     * @var float
     */
    protected $spamScore;
    /**
     * @var array
     */
    protected $attachments;

    function __construct($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBodyHtml() {
        return $this->bodyHtml;
    }

    /**
     * @param mixed $bodyHtml
     * @return Message
     */
    public function setBodyHtml($bodyHtml) {
        $this->bodyHtml = $bodyHtml;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBodyPlain() {
        return $this->bodyPlain;
    }

    /**
     * @param mixed $bodyPlain
     * @return Message
     */
    public function setBodyPlain($bodyPlain) {
        $this->bodyPlain = $bodyPlain;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrippedHtml() {
        return $this->strippedHtml;
    }

    /**
     * @param mixed $strippedHtml
     * @return Message
     */
    public function setStrippedHtml($strippedHtml) {
        $this->strippedHtml = $strippedHtml;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReplyTo() {
        return $this->replyTo;
    }

    /**
     * @param mixed $replyTo
     * @return Message
     */
    public function setReplyTo($replyTo) {
        $this->replyTo = $replyTo;
        return $this;
    }


    /**
     * @param mixed $from
     * @return Message
     */
    public function setFrom($from) {
        if(preg_match("~(.+)<[^>]+>$~", $from, $fromName)) {
            $this->fromName = $fromName[1];
        }
        preg_match("~[^<]+@[^>]+$~", $from, $fromEmail);
        if(!$fromEmail[0]) {
            preg_match("~[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}~i", $from, $fromEmail);
        }
        $this->fromEmail = $fromEmail[0];
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Message
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return Message
     */
    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThreadIndex() {
        return $this->threadIndex;
    }

    /**
     * @param mixed $threadIndex
     * @return Message
     */
    public function setThreadIndex($threadIndex) {
        $this->threadIndex = $threadIndex;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSpam() {
        return $this->spam;
    }

    /**
     * @param boolean $spam
     * @return Message
     */
    public function setSpam($spam) {
        $this->spam = $spam;
        return $this;
    }

    /**
     * @return float
     */
    public function getSpamScore() {
        return $this->spamScore;
    }

    /**
     * @param float $spamScore
     * @return Message
     */
    public function setSpamScore($spamScore) {
        $this->spamScore = $spamScore;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments() {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     * @return Message
     */
    public function setAttachments($attachments) {
        $this->attachments = $attachments;
        return $this;
    }


}
