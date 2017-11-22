<?php


namespace ValidatorBundle\Exception;

use Throwable;
use ValidatorBundle\Service\Translator;

class InvalidDataException extends \Exception
{
    public function __construct($langCode = 'tr', Throwable $previous = null)
    {
        $translator = new Translator('exception_responses', $langCode);
        $message = $langCode.' :: '.$translator->getTranslation('412.0200');
        parent::__construct($message, 412, $previous);
    }
}