<?php

namespace Octopy\PixaDump;

use Octopy\PixaDump\Payloads\LogPayload;
use Octopy\PixaDump\Payloads\Payload;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class Factory
{
    /**
     * @param  mixed $value
     * @return Payload
     */
    public static function getPayload(mixed $value) : Payload
    {
        return new LogPayload(static::convertToPrimitive(
            $value
        ));
    }

    /**
     * @param  array $values
     * @return Payload[]
     */
    public static function getPayloads(array $values) : array
    {
        return array_map([static::class, 'getPayload'], $values);
    }

    /**
     * @param  mixed $value
     * @return mixed
     */
    private static function convertToPrimitive(mixed $value) : mixed
    {
        if (is_null($value)) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if (is_int($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value;
        }

        $cloner = new VarCloner;
        $dumper = new HtmlDumper;

        $output = $dumper->dump($cloner->cloneVar($value), true, [
            //
        ]);

        if (preg_match('/<pre(?:\s+[^>]+)?>\s*(.*?)\s*<\/pre>/s', $output, $match)) {
            return $match[0];
        }

        return $output;
    }
}
