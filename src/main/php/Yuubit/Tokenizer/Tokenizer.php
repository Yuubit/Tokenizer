<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/2/19
 * Time: 5:32 PM
 */

namespace Yuubit\Tokenizer;


use Yuubit\Tokenizer\Exception\ParsingException;

class Tokenizer
{
    /**
     * @var array
     */
    private $tokens;

    /**
     * @var string
     */
    private $string;

    /**
     * @var int
     */
    private $size;

    private $pos = 0;

    /**
     * Tokenizer constructor.
     * @param array $tokens
     */
    public function __construct(array $tokens)
    {
        $this->tokens = array_reverse($tokens, true);
    }

    /**
     * @param string $string
     * @return IStream
     */
    function tokenize(string $string)
    {
        $this->string = $string;
        $this->size = strlen($this->string);

        return new LazyStream($this);
    }

    /**
     * @return Token|null
     * @throws ParsingException
     */
    function getNext()
    {
        $length = 1;
        $longest = null;

        if($this->pos === $this->size) {
            return null;
        }

        while ($this->pos + $length <= $this->size) {
            $sub = substr($this->string, $this->pos, $length);
            $tmp = $this->getBestMatch($sub);

            if ($tmp !== null) {
                $longest = $tmp;
            }

            $length++;
        }

        if($longest === null) {
            throw new ParsingException(substr($this->string, $this->pos));
        }

        $this->pos = $longest->getOffset() + $longest->getLength();

        return $longest;
    }

    /**
     * @param string $str
     * @return null|Token
     */
    private function getBestMatch(string $str)
    {
        $match = null;

        foreach ($this->tokens as $type => $token) {
            if (preg_match("/" . $token . "/", $str) === 1) {
                $match = new Token(
                    $str,
                    $this->pos,
                    strlen($str),
                    $type
                );
            }
        }

        return $match;
    }
}