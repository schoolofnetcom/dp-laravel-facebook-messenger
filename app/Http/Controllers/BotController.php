<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeBot\WebHook;
use CodeBot\SenderRequest;
use CodeBot\Build\Solid;
use CodeBot\Element\Button;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\CallSendApi;

class BotController extends Controller
{
    public function subscribe()
    {
        $subscribe = (new WebHook)->check('uendow84nfd93nsl384nf');

        if (!$subscribe) {
            abort(403, 'Unauthorized action');
        }

        return $subscribe;
    }

    public function receiveMessaging()
    {
        $sender = new SenderRequest;
        $senderId = $sender->getSenderId();
        $postback = $sender->getPostback();

        $message = new ButtonsTemplate($senderId);
        $callSendApi = new CallSendApi('EAABZBoGGSUkwBAOdPofvf19ebRDHr6RREMQsUYgPSupIYrjMg96n0xMZC9TJWZBmSIfM0I8M8u1pnAjZBY9rcXPAMHtUuSoZCZA6ZC5MGLhIP7VK7FhUZCLStucHDofU2LZA7PMhTajoe0b9sjjfkQiqnKQgPvZBKPZBTWwemjhNakdzwZDZD');

        if ($postback === 'abrir_site') {
            $message->add(new Button('web_url', 'Google', 'https://www.google.com.br'));
            $callSendApi->make($message->message('Que tal testarmos a abertura de um site?'));
        } else if ($postback === 'outro_fluxo') {
            $message->add(new Button('postback', 'Abrir site', 'abrir_site'));
            $callSendApi->make($message->message('Legal, né, vamos tentar uma pesquisa?'));
        } else {
            $message->add(new Button('postback', 'Botão 1', 'abrir_site'));
            $message->add(new Button('postback', 'Botão 2', 'abrir_site'));
            $message->add(new Button('postback', 'Botão 3', 'abrir_site'));
            $callSendApi->make($message->message('Vamos testar um postback'));

            $message = new ButtonsTemplate($senderId);

            $message->add(new Button('postback', 'Botão 4', 'outro_fluxo'));
            $message->add(new Button('postback', 'Botão 5', 'outro_fluxo'));
            $message->add(new Button('postback', 'Botão 6', 'outro_fluxo'));
            $callSendApi->make($message->message('Mais algumas opções'));
        }

        return '';
    }

    public function addMenu()
    {
        $bot = Solid::factory();
        Solid::pageAccessToken('EAABZBoGGSUkwBAOdPofvf19ebRDHr6RREMQsUYgPSupIYrjMg96n0xMZC9TJWZBmSIfM0I8M8u1pnAjZBY9rcXPAMHtUuSoZCZA6ZC5MGLhIP7VK7FhUZCLStucHDofU2LZA7PMhTajoe0b9sjjfkQiqnKQgPvZBKPZBTWwemjhNakdzwZDZD');

        $menu = [
            [
                'id' => 1,
                'type' => 'nested',
                'title' => 'Quais minhas opções?',
                'parent_id' => 0,
                'value' => null
            ],
            [
                'id' => 2,
                'type' => 'postback',
                'title' => 'Abrir site',
                'parent_id' => 0,
                'value' => 'abrir_site'
            ],
            [
                'id' => 3,
                'type' => 'web_url',
                'title' => 'Google',
                'parent_id' => 1,
                'value' => 'https://www.google.com.br'
            ],
            [
                'id' => 4,
                'type' => 'postback',
                'title' => 'Outro fluxo',
                'parent_id' => 1,
                'value' => 'outro_fluxo'
            ],
        ];

        $bot->addMenu('default', true, $menu);
    }

    public function removeMenu()
    {
        $bot = Solid::factory();
        Solid::pageAccessToken('EAABZBoGGSUkwBAOdPofvf19ebRDHr6RREMQsUYgPSupIYrjMg96n0xMZC9TJWZBmSIfM0I8M8u1pnAjZBY9rcXPAMHtUuSoZCZA6ZC5MGLhIP7VK7FhUZCLStucHDofU2LZA7PMhTajoe0b9sjjfkQiqnKQgPvZBKPZBTWwemjhNakdzwZDZD');

        $bot->removeMenu();
    }

    public function addGetStarted()
    {
        $bot = Solid::factory();
        Solid::pageAccessToken('EAABZBoGGSUkwBAOdPofvf19ebRDHr6RREMQsUYgPSupIYrjMg96n0xMZC9TJWZBmSIfM0I8M8u1pnAjZBY9rcXPAMHtUuSoZCZA6ZC5MGLhIP7VK7FhUZCLStucHDofU2LZA7PMhTajoe0b9sjjfkQiqnKQgPvZBKPZBTWwemjhNakdzwZDZD');

        $bot->addGetStartedButton('outro_fluxo');
    }

    public function removeGetStarted()
    {
        $bot = Solid::factory();
        Solid::pageAccessToken('EAABZBoGGSUkwBAOdPofvf19ebRDHr6RREMQsUYgPSupIYrjMg96n0xMZC9TJWZBmSIfM0I8M8u1pnAjZBY9rcXPAMHtUuSoZCZA6ZC5MGLhIP7VK7FhUZCLStucHDofU2LZA7PMhTajoe0b9sjjfkQiqnKQgPvZBKPZBTWwemjhNakdzwZDZD');

        $bot->removeGetStartedButton();
    }
}
