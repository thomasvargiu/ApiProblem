<?php

declare(strict_types=0);

namespace Crell\ApiProblem;

use PHPUnit\Framework\TestCase;

/**
 * Test for the JSON error handling.
 *
 * @todo Add tests for something other than invalid syntax, as that's all I
 * can figure out how to cause. :-)
 */
class JsonErrorTest extends TestCase
{

    /**
     * @expectedException \Crell\ApiProblem\JsonParseException
     * @expectedExceptionCode JSON_ERROR_SYNTAX
     */
    public function testMalformedJson() : void
    {
        // Note the stray comma.
        $json = '{"a": "b",}';
        ApiProblem::fromJson($json);
    }

    public function testJsonExceptionString() : void
    {
        // Note the stray comma.
        $json = '{"a": "b",}';

        try {
            ApiProblem::fromJson($json);
        }
        catch (JsonParseException $e) {
            $this->assertEquals($json, $e->getJson());
        }
    }
}
