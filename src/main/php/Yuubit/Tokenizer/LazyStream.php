<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/2/19
 * Time: 5:32 PM
 */

namespace Yuubit\Tokenizer;


class LazyStream implements IStream
{
    /**
     * @var Tokenizer
     */
    private $tokenizer;

    /**
     * LazyStream constructor.
     * @param Tokenizer $tokenizer
     */
    public function __construct(Tokenizer $tokenizer)
    {
        $this->tokenizer = $tokenizer;
    }

    /**
     * {@inheritdoc}
     */
    function nextToken()
    {
        return $this->tokenizer->getNext();
    }

    /**
     * {@inheritdoc}
     */
    function toArray(): array {
        $tokens = [];

        while($token = $this->nextToken()) {
            $tokens[] = $token;
        }

        return $tokens;
    }
}