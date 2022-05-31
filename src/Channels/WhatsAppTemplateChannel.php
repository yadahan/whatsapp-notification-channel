<?php

namespace Yadahan\WhatsAppNotificationChannel\Channels;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Notifications\Notification;

class WhatsAppTemplateChannel
{
    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * The api url.
     *
     * @var string
     */
    protected $url;

    /**
     * The api key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new WhatsApp channel instance.
     *
     * @param  \GuzzleHttp\Client  $http
     * @param  string  $url
     * @param  string  $apiKey
     * @param  string  $from
     * @return void
     */
    public function __construct(HttpClient $http/*, $url, $apiKey, $from*/)
    {
        $this->http = $http;
        $this->url = config('99digital.api_url')/*$url*/;
        $this->apiKey = config('99digital.api_key')/*$apiKey*/;
        $this->from = config('99digital.from')/*$from*/;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('whatsapp', $notification)) {
            return;
        }

        $message = $notification->toWhatsApp($notifiable);

        $payload = array_filter([
            'apiKey' => $this->apiKey,
            'from' => $message->number ?: $this->from,
            'to' => $to,
            'name' => $message->name,
            'language' => $this->language($message->language),
            'headerType' => $this->headerType($message->headerType),
            'headerLink' => $message->headerLink,
            'bodyVariable1' => $message->bodyVariable[0] ?? null,
            'bodyVariable2' => $message->bodyVariable[1] ?? null,
            'bodyVariable3' => $message->bodyVariable[2] ?? null,
            'bodyVariable4' => $message->bodyVariable[3] ?? null,
            'bodyVariable5' => $message->bodyVariable[4] ?? null,
            'websiteVariable' => $message->websiteVariable,
        ]);

        return $this->http->post('https://api.99digital.co.il/whatsapp/v2/sendTemplate', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $payload,
        ]);
    }

    public function language($locale)
    {
        return match ($locale) {
            'en' => 2,
            'ar' => 3,
            'ru' => 4,
            'es' => 5,
            'zh' => 6,
            'hi' => 7,
            'th' => 8,
            'fr' => 9,
            default => 1,
        };
    }

    public function headerType($type)
    {
        return match ($type) {
            'image' => 3,
            'video' => 4,
            'document' => 5,
            default => 1,
        };
    }
}
