<?php
namespace Soukicz\Mailgun;

class Encoding {
    public static function fixUtfHtml($html) {
        return preg_replace_callback('~^.*?<html>.*?<head>(.*?)</head>.*?<body[^>]*>.*</body>.*?</html>.*?$~is', function ($m) {

            $html = $m[0];
            $head = $m[1];
            $legacyPattern = '~<meta\s+http-equiv=["\']content-type["\']\s+content="text/html;\s+charset=([a-z0-9\-]+)["\']\s*/?>~i';
            $pattern = '~<meta\s+charset\s*=\s*["\']([a-z0-9\-]+)["\']\s*>~i';
            if(preg_match($legacyPattern, $head, $encoding)) {
                $fromEncoding = strtoupper($encoding[1]);
            } elseif(preg_match($pattern, $head, $encoding)) {
                $fromEncoding = strtoupper($encoding[1]);
            }
            if(isset($fromEncoding) && strtoupper($encoding[1]) !== 'UTF-8') {
                if(strpos($fromEncoding, 'WINDOWS-') === 0) {
                    $fromEncoding = str_ireplace('windows-', 'CP', $fromEncoding);
                }
                $newHtml = iconv($fromEncoding, 'UTF-8', $html);
                if($newHtml) {
                    $html = $newHtml;
                    $html = preg_replace($legacyPattern, '<meta charset="UTF-8">', $html);
                    $html = preg_replace($pattern, '<meta charset="UTF-8">', $html);
                }

            }
            return $html;
        }, $html);
    }
}
