<?php
/**
 * Created by IntelliJ IDEA.
 * User: felix
 * Date: 1/2/19
 * Time: 5:32 PM
 */

namespace Yuubit\Tokenizer;


class Token
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $length;

    /**
     * @var mixed
     */
    private $type;

    /**
     * Token constructor.
     * @param string $value
     * @param int $offset
     * @param int $length
     * @param mixed $type
     */
    public function __construct(string $value, int $offset, int $length, $type)
    {
        $this->value = $value;
        $this->offset = $offset;
        $this->length = $length;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

}