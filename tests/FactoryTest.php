<?php
namespace Soukicz\TestMailgun;


use GuzzleHttp\Psr7\Request;
use Soukicz\Mailgun\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase {
    function testPlainMessage() {
        $factory = new Factory('key');

        $message = $factory->convertRequestToMessage(new Request(
            'POST',
            '/',
            [],
            http_build_query(json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'message-plain.json'), true))
        ));

        $this->assertEquals('', $message->getBodyHtml());
        $this->assertEquals('Dobry den, zdravime za test.cz.', $message->getBodyPlain());
        $this->assertEquals(new \DateTime('2016-05-04T16:08:13+0200'), $message->getDate());
        $this->assertEquals([], $message->getAttachments());
        $this->assertEquals('adam@novak.cz', $message->getFromEmail());
        $this->assertEquals('Adam Novak', $message->getFromName());
        $this->assertEquals('<a4aa0f7a-2a17-3e86-3a89-ec674e35d63a@test.cz>', $message->getId());
        $this->assertEquals('', $message->getReferences());
        $this->assertEquals('', $message->getReplyTo());
        $this->assertEquals(0, $message->getSpamScore());
        $this->assertEquals('', $message->getStrippedHtml());
        $this->assertEquals('', $message->getSubject());
        $this->assertEquals('', $message->getThreadIndex());
        $this->assertEquals('info@test.cz', $message->getToEmail());
        $this->assertEquals('', $message->getToName());
    }
}
