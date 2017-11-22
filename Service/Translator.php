<?php
namespace ValidatorBundle\Service;

use Symfony\Component\Yaml\Yaml;

class Translator
{

    public $messages = [];

    /**
     * EduSysTranslator constructor.
     * @param string $domain
     * @param string $locale
     */
    public function __construct(string $domain = 'response_codes', string $locale = 'tr')
    {
        $this->messages = $this->load($domain, $locale);
    }

    /**
     * @param string $domain
     * @param string $locale
     * @return mixed
     */
    public function load(string $domain = 'response_codes', string $locale = 'tr')
    {

        $yamlContents = Yaml::parse(file_get_contents('../src/ValidatorBundle/Resources/translations/'.$domain.'.yml'));

        foreach($yamlContents as $key => $translatedValues){
            $this->messages[$key] = isset($translatedValues[$locale]) ? $translatedValues[$locale] : '';
        }

        return $this->messages;
    }

    /**
     * @param string $key
     * @param array $replacementArray
     * @return \InvalidArgumentException|mixed
     */
    public function getTranslation(string $key, array $replacementArray = []){

        $pattern = '/[\?][\?]/';
        if(!isset($this->messages[$key])){
            /**
             * TODO: exception dönmeli mi karar verip, ona göre düzenleme yapılmalı.
             */
            return '';
        }
        preg_match_all($pattern, $this->messages[$key], $matches);
        $matchCount = count($matches);
        if($matchCount > 0 && $matchCount != count($replacementArray)){
            // TODO throw Exception
        }
        $message = $this->messages[$key];
        if ($matchCount > 0) {
            foreach($replacementArray as $toReplace){
                $message = preg_replace($pattern, $toReplace, $message, 1);
            }
        }
        return $message;

    }

}