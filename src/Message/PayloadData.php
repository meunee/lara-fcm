<?php

namespace Meunee\LaraFcm\Message;

/**
 * Class PayloadData.
 */
class PayloadData
{
    /**
     * @internal
     *
     * @var array
     */
    protected $data;

    /**
     * PayloadData constructor.
     *
     * @param PayloadDataBuilder $builder
     */
    public function __construct(PayloadDataBuilder $builder)
    {
        $this->data = $builder->getData();
    }

    /**
     * Transform payloadData to string.
     *
     * @return string
     */
    public function toString()
    {
        return json_encode($this->data);
    }
}
