<?php

namespace Tasksuki\Component\PhpSerializer\Test;

use Tasksuki\Component\Message\Message;
use Tasksuki\Component\PhpSerializer\PhpSerializer;
use PHPUnit\Framework\TestCase;

class PhpSerializerTest extends TestCase
{
    public function testSerialize()
    {
        $message = new Message();
        $message
            ->setData(['foo' => 'bar'])
            ->setName('foo_bar');

        $serializer = new PhpSerializer();

        $this->assertEquals($serializer->serialize($message), serialize($message));
    }

    public function testUnserialize()
    {
        $expected = new Message();
        $expected
            ->setData(['foo' => 'bar'])
            ->setName('foo_bar');

        $given = serialize($expected);

        $serializer = new PhpSerializer();

        $this->assertEquals($expected, $serializer->unserialize($given));
    }

    /**
     * @expectedException Tasksuki\Component\Serializer\Exception\NotValidInputException
     */
    public function testUnserializeFail()
    {
        $input = '$$';

        $serializer = new PhpSerializer();

        $this->setExpectedExceptionFromAnnotation();

        $serializer->unserialize($input);
    }
}
