<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/2/19
 * Time: 2:54 PM
 */

namespace Yuubit\URI\Internal;


use Nette\Tokenizer\Tokenizer;
use PHPUnit\Framework\TestCase;
use Yuubit\URI\Parts;

class URITokenizerTest extends TestCase
{
    const URI = "http://yuubit.de//anders.de/./simple/path?a=5#somewhere";
    const MULTI_QUERY = "http://yuubit.de//test.de/./simple/path?a=5&b=6#somewhere";

    /**
     * @var URITokenizer
     */
    private $tokenizer;

    protected function setUp()
    {
        $this->tokenizer = new URITokenizer();
    }

    function testTokenize() {
        $tokenizer = new Tokenizer([
            1 => '((\?[\-._\~A-Za-z0-9]+=[\-._\~A-Za-z0-9]+)(&[\-._\~A-Za-z0-9]+=[\-._\~A-Za-z0-9]+)+)|(\?[\-._\~A-Za-z0-9]+=[\-._\~A-Za-z0-9]+)',
            2 => "[\-._\~A-Za-z0-9]+"
        ]);

        $tokens = $tokenizer->tokenize("bla");
        var_dump($tokens);

        $tokens = $this->tokenizer->tokenizeURI(self::URI);

        self::assertEquals($tokens[(string) Parts::SCHEME], "http:");
        self::assertEquals($tokens[(string) Parts::AUTHORITY], "//yuubit.de");
        self::assertEquals($tokens[(string) Parts::PATH], "/./simple/path");
        self::assertEquals($tokens[(string) Parts::QUERY], "?a=5");
        self::assertEquals($tokens[(string) Parts::FRAGMENT], "#somewhere");
    }

    function testMultiQuery() {
        $tokens = $this->tokenizer->tokenizeURI(self::MULTI_QUERY);

        self::assertEquals($tokens[(string) Parts::SCHEME], "http:");
        self::assertEquals($tokens[(string) Parts::AUTHORITY], "//yuubit.de");
        self::assertEquals($tokens[(string) Parts::PATH], "/./simple/path");
        self::assertEquals($tokens[(string) Parts::QUERY], "?a=5&b=6");
        self::assertEquals($tokens[(string) Parts::FRAGMENT], "#somewhere");
    }
}