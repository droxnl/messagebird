<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class MessageBirdTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetBalance(): void
    {
        $client = $this->createMock(\MessageBird\Client::class);
        $balance = $this->createMock(\MessageBird\Resources\Balance::class);
        $client->balance = $balance;
        $balance->method('read')->willReturn('100');
        $messageBird = new \Droxnl\Messagebird\MessageBird($client);
        $this->assertEquals('100', $messageBird->getBalance());
    }

    /**
     * @return void
     */
    public function testGetBalanceException(): void
    {
        $client = $this->createMock(\MessageBird\Client::class);
        $balance = $this->createMock(\MessageBird\Resources\Balance::class);
        $client->balance = $balance;
        $balance->method('read')->will($this->throwException(new \MessageBird\Exceptions\AuthenticateException()));
        $messageBird = new \Droxnl\Messagebird\MessageBird($client);
        $this->assertEquals('Authentication failed, check your access key', $messageBird->getBalance());
    }

    /**
     * @return void
     */
    public function testCreateMessage(): void
    {
        $client = $this->createMock(\MessageBird\Client::class);
        $messages = $this->createMock(\MessageBird\Resources\Messages::class);
        $client->messages = $messages;
        $message = $this->createMock(\MessageBird\Objects\Message::class);
        $messages->method('create')->willReturn($message);
        $messageBird = new \Droxnl\Messagebird\MessageBird($client);
        $this->assertEquals($message, $messageBird->createMessage('test', 'test', 'test'));
    }
}
