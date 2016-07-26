<?php
namespace Soukicz\TestMailgun;

use Soukicz\Mailgun\Message;

class AddressTest extends \PHPUnit_Framework_TestCase {
    function testSimple() {
        $message = new Message(1);
        $message->setFrom('Adam Novak <adam@novak.cz>');
        $this->assertEquals('adam@novak.cz', $message->getFromEmail());
        $this->assertEquals('Adam Novak', $message->getFromName());
    }

    function testWhitespace() {
        $message = new Message(1);
        $message->setFrom('Ivana Sikelová - petpark.sk' . "\t" . '<sikelova@petpark.sk>');
        $this->assertEquals('sikelova@petpark.sk', $message->getFromEmail());
        $this->assertEquals('Ivana Sikelová - petpark.sk', $message->getFromName());
    }
}
