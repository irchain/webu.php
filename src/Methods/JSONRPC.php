<?php

/**
 * This file is part of webu.php package.
 *
 * @author dreamxyp <dreamxyp@gmail.com>
 * @license MIT
 */

namespace Webu\Methods;

use InvalidArgumentException;
use Webu\Methods\IRPC;

class JSONRPC implements IRPC
{
    /**
     * id
     * 
     * @var int
     */
    protected $id = 0;

    /**
     * rpcVersion
     * 
     * @var string
     */
    protected $rpcVersion = '2.0';

    /**
     * method
     * 
     * @var string
     */
    protected $method = '';

    /**
     * arguments
     * 
     * @var array
     */
    protected $arguments = [];

    /**
     * construct
     * 
     * @param string $method
     * @param array $arguments
     * @return void
     */
    public function __construct($method, $arguments)
    {
        $this->method    = $method;
        $this->arguments = $arguments;
    }

    /**
     * __toString
     * 
     * @return string
     */
    public function __toString()
    {
        $payload = $this->toPayload();

        return json_encode($payload);
    }

    /**
     * setId
     * 
     * @param int $id
     * @return bool
     */
    public function setId($id)
    {
        if (!is_int($id)) {
            throw new InvalidArgumentException('Id must be integer.');
        }
        $this->id = $id;

        return true;
    }

    /**
     * getId
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getRpcVersion
     * 
     * @return string
     */
    public function getRpcVersion()
    {
        return $this->rpcVersion;
    }

    /**
     * getMethod
     * 
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * setArguments
     * 
     * @param array $arguments
     * @return bool
     */
    public function setArguments($arguments)
    {
        if (!is_array($arguments)) {
            throw new InvalidArgumentException('Please use array when call setArguments.');
        }
        $this->arguments = $arguments;

        return true;
    }

    /**
     * getArguments
     * 
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * toPayload
     * 
     * @return array
     */
    public function toPayload()
    {
        if (empty($this->method) || !is_string($this->method)) {
            throw new \InvalidArgumentException('Please check the method set properly.');
        }
        if (empty($this->id)) {
            $id = rand();
        } else {
            $id = $this->id;
        }
        $rpc = [
            'id'      => $id,
            'jsonrpc' => $this->rpcVersion,
            'method'  => $this->method
        ];

        if (count($this->arguments) > 0) {
            $rpc['params'] = $this->arguments;
        }
        return $rpc;
    }

    /**
     * toPayloadString
     * 
     * @return string
     */
    public function toPayloadString()
    {
        $payload = $this->toPayload();
        return json_encode($payload);
    }
}