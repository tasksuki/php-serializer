<?php

namespace Tasksuki\Component\PhpSerializer;

use Tasksuki\Component\Message\Message;
use Tasksuki\Component\Serializer\Exception\NotValidInputException;
use Tasksuki\Component\Serializer\SerializerInterface;

/**
 * Class PhpSerializer
 *
 * @package Tasksuki\Component\PhpSerializer
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class PhpSerializer implements SerializerInterface
{
    /**
     * @param Message $message
     *
     * @return string
     */
    public function serialize(Message $message): string
    {
        return serialize($message);
    }

    /**
     * @param string $data
     *
     * @return Message
     * @throws NotValidInputException
     */
    public function unserialize(string $data): Message
    {
        $message = @unserialize($data);

        if (false === ($message instanceof Message)) {
            throw new NotValidInputException();
        }

        return $message;
    }

}