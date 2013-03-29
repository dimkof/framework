<?php

namespace Core;

class Registry {

    /**
     * @var array class instance
     */
    private static $_instance = array();

    /**
     * @var array data
     */
    private $_data = array();

    /**
     * @param array $data
     * @return class instance
     */
    public static function instance($instance = 'default', $data = array())
    {
        if(
            ! array_key_exists($instance, self::$_instance)
            OR ! (self::$_instance[$instance] instanceof self)
        )
        {
            self::$_instance[$instance] = new self($data);
        }

        return self::$_instance[$instance];
    }

    /**
     * @param array $data
     */
    private function __construct($data = array())
    {
        if ( ! empty($data) )
        {
            foreach($data as $key => $value)
            {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        if ( ! array_key_exists($key, $this->_data) )
        {
            $this->_data[$key] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function __get($key)
    {
        if ( array_key_exists($key, $this->_data) )
        {
            return $this->_data[$key];
        }
        else
        {
            return null;
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        if ( ! array_key_exists($key, $this->_data) )
        {
            $this->_data[$key] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function get($key)
    {
        if ( array_key_exists($key, $this->_data) )
        {
            return $this->_data[$key];
        }
        else
        {
            return null;
        }
    }

    /**
     * Remove properties
     *
     * @param string $key - property name
     */
    public function remove($key)
    {
        if ( array_key_exists($key, $this->_data) )
        {
            unset($this->_data[$key]);
        }
    }
}
