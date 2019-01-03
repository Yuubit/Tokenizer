<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/2/19
 * Time: 2:54 PM
 */

namespace Yuubit\Tokenizer;


use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase
{
    const URI = "http://yuubit.de//anders.de/./simple/path?a=5#somewhere";
    const MULTI_QUERY = "http://yuubit.de//test.de/./simple/path?a=5&b=6#somewhere";

    /**
     * @var Tokenizer
     */
    private $tokenizer;

    protected function setUp()
    {
        $this->tokenizer = new Tokenizer([
            0 => '((^\?[\-._\~A-Za-z0-9]+=[\-._\~A-Za-z0-9]+)(&[\-._\~A-Za-z0-9]+=[\-._\~A-Za-z0-9]+)+$)|(^\?[\-._\~A-Za-z0-9]+=[\-._\~A-Za-z0-9]+$)',
            1 => "^[\-._\~A-Za-z0-9]+$"
        ]);
    }

    function testTokenize() {
        $tokens = $this->tokenizer->tokenize("bla?a=5&b=7")->toArray();

        self::assertEquals(1, $tokens[0]->getType());
        self::assertEquals("bla", $tokens[0]->getValue());
        self::assertEquals(0, $tokens[0]->getOffset());
        self::assertEquals(3, $tokens[0]->getLength());

        self::assertEquals(0, $tokens[1]->getType());
        self::assertEquals("?a=5&b=7", $tokens[1]->getValue());
        self::assertEquals(3, $tokens[1]->getOffset());
        self::assertEquals(8, $tokens[1]->getLength());
    }
}