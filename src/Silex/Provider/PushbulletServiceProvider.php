<?php

namespace PushSilex\Silex\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class PushbulletServiceProvider implements ServiceProviderInterface
{
    private $accessToken;

    const URI = 'https://api.pushbullet.com/v2/pushes';
    const NOTE = 'note';
    const LINK = 'link';

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function register(Application $app)
    {
        $app['pushbullet.note'] = $app->protect(function ($title, $body) {
            return $this->push('note', $title, $body);
        });
    }

    private function push($type, $title, $body)
    {
        $data = [
            'type'  => $type,
            'title' => $title,
            'body'  => $body,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => self::URI,
            CURLOPT_HTTPHEADER     => ['Content-Type' => 'application/json'],
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
            CURLOPT_USERPWD        => $this->accessToken . ':',
            CURLOPT_RETURNTRANSFER => true
        ]);
        $out = curl_exec($ch);
        curl_close($ch);

        return json_decode($out);
    }

    public function boot(Application $app)
    {
    }
}