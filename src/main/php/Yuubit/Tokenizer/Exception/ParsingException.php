<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/3/19
 * Time: 12:24 PM
 */

namespace Yuubit\Tokenizer\Exception;


use Throwable;

class ParsingException extends \Exception
{
    public function __construct(string $part)
    {
        parent::__construct("Part of the string cannot be parsed as Token.\nNear: $part");
    }

}