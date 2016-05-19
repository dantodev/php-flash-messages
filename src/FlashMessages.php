<?php namespace Dtkahl\FlashMessages;
class FlashMessages
{
  private $prev;

  private $storage;

  /**
   * FlashMessages constructor.
   * @param array|null $storage
   * @param string $key
   */
  public function __construct(array &$storage = null, $key = "flash")
  {
    if (is_null($storage)) {
      $storage = &$_SESSION;
    } elseif (!is_array($storage) && !$storage instanceof \ArrayAccess){
      throw new \InvalidArgumentException("Given storage must be array or extend ArrayAccess.");
    }
    $this->prev = array_key_exists($key, $storage) ? (array) $storage[$key] : [];

    $storage[$key] = [];
    $this->storage = &$storage[$key];
  }

  /**
   * @param $key
   * @param null $default
   * @return null
   */
  public function get($key, $default = null)
  {
    return $this->has($key) ? $this->prev[$key] : $default;
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function set($key, $value)
  {
    $this->storage[$key] = $value;
    return $this;
  }

  /**
   * @return array
   */
  public function all()
  {
    return $this->prev;
  }

  /**
   * @param $key
   * @return $this
   */
  public function remove($key)
  {
    if (array_key_exists($key, $this->storage)) {
      unset($this->storage[$key]);
    }
    return $this;
  }

  /**
   * @param $key
   * @return bool
   */
  public function has($key)
  {
    return array_key_exists($key, $this->prev);
  }
}