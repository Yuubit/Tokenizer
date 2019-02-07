<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/3/19
 * Time: 11:48 AM
 */

namespace Yuubit\Tokenizer;


interface IStream
{
    /**
     * @return Token|null
     */
    function nextToken();

    /**
     * @return Token[]
     */
    function toArray();
}