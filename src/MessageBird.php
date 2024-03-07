<?php

declare(strict_types=1);

namespace src;

use MessageBird\Client;
use MessageBird\Objects\BaseList;
use MessageBird\Objects\Hlr;
use MessageBird\Objects\Lookup;
use MessageBird\Objects\Message;
use MessageBird\Objects\Verify;
use MessageBird\Objects\VoiceMessage;
use MessageBird\Resources\Balance;
use MessageBird\Resources\Messages;

class MessageBird
{
    /** @var Client $client */
    public Client $client;

    /** @var array $errorMessages */
    public array $errorMessages = [];

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return [
            'authentication' => 'Authentication failed, check your access key',
            'balance' => 'Not enough balance on your account',
        ];
    }

    /**
     * @return Balance|mixed|string
     */
    public function getBalance()
    {
        try {
            return $this->client->balance->read();
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $msisdn
     * @param $reference
     * @return \MessageBird\Objects\Balance|Hlr|Lookup|Message|Verify|VoiceMessage|mixed|string
     */
    public function createHlr($msisdn, $reference)
    {
        $hlr            = new Hlr;
        $hlr->msisdn    = $msisdn;
        $hlr->reference = $reference;

        try {
            return $this->client->hlr->create($hlr);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\MessageBird\Exceptions\BalanceException $e) {
            return $this->errorMessages['balance'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return BaseList|\MessageBird\Resources\Hlr|mixed|string
     */
    public function listHlrs(int $offset = 100, int $limit = 30)
    {
        try {
            return $this->client->hlr->getList(['offset' => $offset, 'limit' => $limit]);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return \MessageBird\Resources\Hlr|mixed|string
     */
    public function viewHlr($id)
    {
        try {
            return $this->client->hlr->read($id);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $originator
     * @param $recipients
     * @param $body
     * @return \MessageBird\Objects\Balance|Hlr|Lookup|Message|Verify|VoiceMessage|mixed|string
     */
    public function createMessage($originator, $recipients = [], $body)
    {
        $message             = new \MessageBird\Objects\Message;
        $message->originator = $originator;
        $message->recipients = $recipients;
        $message->body       = $body;

        try {
            return $this->client->messages->create($message);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\MessageBird\Exceptions\BalanceException $e) {
            return $this->errorMessages['balance'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return bool|mixed|string
     */
    public function deleteMessage($id)
    {
        try {
            return $this->client->messages->delete($id);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return BaseList|Messages|mixed|string
     */
    public function listMessages(int $offset = 100, int $limit = 30)
    {
        try {
            return $this->client->messages->getList(['offset' => $offset, 'limit' => $limit]);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return Messages|mixed|string
     */
    public function viewMessage($id)
    {
        try {
            return $this->client->messages->read($id);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            return $this->errorMessages['authentication'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}