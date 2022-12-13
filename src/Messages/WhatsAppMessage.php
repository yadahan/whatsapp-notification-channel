<?php

namespace Yadahan\WhatsAppNotificationChannel\Messages;

class WhatsAppMessage
{
    /**
     * The api key to use the message.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The phone number to send the message from.
     *
     * @var string
     */
    public $number;

    /**
     * The template name to use the message.
     *
     * @var string
     */
    public $name;

    /**
     * The language to use the message.
     *
     * @var int
     */
    public $language;

    /**
     * The header type to use the message.
     *
     * @var int|null
     */
    public $headerType;

    /**
     * The header link to use the message.
     *
     * @var string|null
     */
    public $headerLink;

    /**
     * The body variables to use the message.
     *
     * @var array|null
     */
    public $bodyVariable;

    /**
     * The website variable to use the message.
     *
     * @var string|null
     */
    public $websiteVariable;

    /**
     * Set the api key.
     *
     * @param  string  $apiKey
     * @return $this
     */
    public function key($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Set a custom from number for the WhatsApp message.
     *
     * @param  string  $number
     * @return $this
     */
    public function from($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Set the WhatsApp template the message should use.
     *
     * @param  string  $name
     * @return $this
     */
    public function template($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the WhatsApp message language.
     *
     * @param  string  $language
     * @return $this
     */
    public function locale($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Set the WhatsApp message header type.
     *
     * @param  int  $headerType
     * @return $this
     */
    public function type($headerType)
    {
        $this->headerType = $headerType;

        return $this;
    }

    /**
     * Set the WhatsApp message header link.
     *
     * @param  string  $headerLink
     * @return $this
     */
    public function link($headerLink)
    {
        $this->headerLink = $headerLink;

        return $this;
    }

    /**
     * Set the WhatsApp message body variables.
     *
     * @param  array  $variables
     * @return $this
     */
    public function variables(array $variables)
    {
        $this->bodyVariable = $variables;

        return $this;
    }

    /**
     * Set the WhatsApp message website variable.
     *
     * @param  string  $websiteVariable
     * @return $this
     */
    public function path($websiteVariable)
    {
        $this->websiteVariable = $websiteVariable;

        return $this;
    }
}
