<?php
namespace Soukicz\TestMailgun;

use Soukicz\Mailgun\Decoder;

class DecoderTest extends \PHPUnit_Framework_TestCase {
    function testSimple() {
        $address = Decoder::getAddress('Adam Novak <adam@novak.cz>');
        $this->assertEquals('adam@novak.cz', $address->getEmail());
        $this->assertEquals('Adam Novak', $address->getName());
    }

    function testWhitespace() {
        $address = Decoder::getAddress('Ivana Nováková - novak.sk' . "\t" . '<novakova@novak.sk>');
        $this->assertEquals('novakova@novak.sk', $address->getEmail());
        $this->assertEquals('Ivana Nováková - novak.sk', $address->getName());
    }

    function testComma() {
        $address = Decoder::getAddress('Mgr. Petra Hrubá, DiS.' . "\t" . '<Hruba.Petulka@seznam.cz>');
        $this->assertEquals('Hruba.Petulka@seznam.cz', $address->getEmail());
        $this->assertEquals('Mgr. Petra Hrubá DiS.', $address->getName());
    }
}
