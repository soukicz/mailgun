<?php
namespace Simplia\Mailgun;

use Psr\Http\Message\RequestInterface;

class Factory {
    public function convertRequestToMessage(RequestInterface $request) {
        parse_str($request->getBody(), $body);
        $message = new Message($body['Message-Id']);

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
        if(!empty($body['body-html'])) {
            $message->setBodyHtml($body['body-html']);
        }
        if(!empty($body['stripped-html'])) {
            $message->setStrippedHtml($body['stripped-html']);
        }
        if(!empty($body['body-plain'])) {
            $message->setBodyPlain($body['body-plain']);
        }
        $message->setSpam(isset($body['X-Mailgun-Sflag']) && $body['X-Mailgun-Sflag'] === 'yes');
        $message->setSpamScore(isset($body['X-Mailgun-Sscore']) ? (float)$body['X-Mailgun-Sscore'] : 0);
    }
}
