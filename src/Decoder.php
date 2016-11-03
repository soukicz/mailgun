<?php
namespace Soukicz\Mailgun;

class Decoder {

    /**
     * @param string $input RFC822 address string
     * @return Address
     */
    public static function getAddress($input) {
        $input = str_replace("\t", ' ', $input);
        $input = str_replace(['(', ')', ':', ';'], '', $input);
        $address = imap_rfc822_parse_adrlist($input, '');
        $name = isset($address[0]->personal) ? trim($address[0]->personal, '"') : null;
        $email = $address[0]->mailbox . '@' . $address[0]->host;


        return new Address($email, $name);
    }
}
