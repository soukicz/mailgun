<?php
namespace Soukicz\Mailgun;

use Psr\Http\Message\RequestInterface;

class Factory {
    protected $key;

    function __construct($apiKey) {
        $this->key = $apiKey;
    }

    /**
     * @param RequestInterface $request
     * @return Message
     */
    public function convertRequestToMessage(RequestInterface $request) {
        parse_str($request->getBody(), $body);
        $message = new Message($body['Message-Id']);

        $message->setSubject($body['Subject']);

        if(!empty($body['Reply-To'])) {
            $message->setReplyTo($body['Reply-To']);
        } elseif(!empty($body['Reply-to'])) {
            $message->setReplyTo($body['Reply-to']);
        } elseif(!empty($body['reply-to'])) {
            $message->setReplyTo($body['reply-to']);
        }
        if(!empty($body['From'])) {
            $message->setFrom($body['From']);
        } else {
            $message->setFrom($body['from']);
        }
        if(isset($body['To'])) {
            $message->setTo($body['To']);
        }
        if(!empty($body['body-html'])) {
            $message->setBodyHtml($body['body-html']);
        }
        if(!empty($body['stripped-html'])) {
            $body['stripped-html'] = html_entity_decode($body['stripped-html']);
            if(strpos($body['stripped-html'], 'ĂĄ') !== false && stripos($body['stripped-html'], 'charset=iso-8859-2')) {
                $body['stripped-html'] = iconv('UTF-8', 'ISO-8859-2', $body['stripped-html']);
            } elseif(strpos($body['stripped-html'], 'Ăˇ') !== false && stripos($body['stripped-html'], 'charset=windows-1250')) {
                $body['stripped-html'] = iconv('UTF-8', 'CP1250', $body['stripped-html']);
            }
            $message->setStrippedHtml($body['stripped-html']);
        }
        if(!empty($body['body-plain'])) {
            $message->setBodyPlain($body['body-plain']);
        }
        if(!empty($body['References'])) {
            $message->setReferences($body['References']);
        }
        $message->setDate((new \DateTime())->setTimestamp($body['timestamp']));
        $message->setSpam(isset($body['X-Mailgun-Sflag']) && $body['X-Mailgun-Sflag'] === 'yes');
        $message->setSpamScore(isset($body['X-Mailgun-Sscore']) ? (float)$body['X-Mailgun-Sscore'] : 0);

        if(isset($body['attachments'])) {
            foreach (json_decode($body['attachments']) as $at) {
                if($at->name == 'smime.p7s') {
                    continue;
                }
                $attachment = new Attachment();
                $attachment
                    ->setName($at->name)
                    ->setUrl(str_replace('https://', 'https://api:key-' . $this->key . '@', $at->url));
                $message->addAttachment($attachment);
            }
        }
        return $message;
    }
}
