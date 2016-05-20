<?php namespace Dtkahl\FlashMessages;
class FlashMessages
{
  
  const TYPE_ERROR = "error";
  const TYPE_WARNING = "warning";
  const TYPE_INFO ="info";
  const TYPE_SUCCESS = "success";

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
   * @param $type
   * @param $key
   * @param $default
   * @return mixed
   */
  public function get($type, $key, $default = null)
  {
    return $this->has($type, $key) ? $this->prev[$type][$key] : $default;
  }

  /**
   * @param $type
   * @param $key
   * @param $value
   * @return $this
   */
  public function set($type, $key, $value)
  {
    if (!array_key_exists($type, $this->storage)) {
      $this->storage[$type] = [];
    };
    $this->storage[$type][$key] = $value;
    return $this;
  }

  /**
   * @param $type
   * @return array
   */
  public function getAll($type)
  {
    return array_key_exists($type, $this->prev) ? $this->prev[$type] : [];
  }

  /**
   * @return array
   */
  public function getAllTypes()
  {
    return $this->prev;
  }

  /**
   * @param $type
   * @param $key
   * @return $this
   */
  public function remove($type, $key)
  {
    if (array_key_exists($type, $this->storage) && array_key_exists($key, $this->storage[$type])) {
      unset($this->storage[$type][$key]);
    }
    return $this;
  }

  /**
   * @param $type
   * @return $this
   */
  public function removeAll($type)
  {
    if (array_key_exists($type, $this->storage)) {
      $this->storage[$type] = [];
    }
    return $this;
  }

  /**
   * @param $type
   * @param $key
   * @return bool
   */
  public function has($type, $key)
  {
    return array_key_exists($type, $this->prev) && array_key_exists($key, $this->prev[$type]);
  }

  public function hasAny($type)
  {
    return !empty($this->getAll($type));
  }

  /**
   * @param $key
   * @param $default
   * @return mixed
   */
  public function getError($key, $default = null)
  {
    return $this->get(self::TYPE_ERROR, $key, $default);
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function setError($key, $value)
  {
    return $this->set(self::TYPE_ERROR, $key, $value);
  }

  /**
   * @param $key
   * @return bool
   */
  public function hasError($key)
  {
    return $this->has(self::TYPE_ERROR, $key);
  }

  /**
   * @return bool
   */
  public function hasAnyError()
  {
    return $this->hasAny(self::TYPE_ERROR);
  }

  /**
   * @return array
   */
  public function getAllError()
  {
    return $this->getAll(self::TYPE_ERROR);
  }

  /**
   * @param $key
   * @return $this
   */
  public function removeError($key)
  {
    return $this->remove(self::TYPE_ERROR, $key);
  }

  /**
   * @return $this
   */
  public function removeAllError()
  {
    return $this->removeAll(self::TYPE_ERROR);
  }

  /**
   * @param $key
   * @param $default
   * @return mixed
   */
  public function getWarning($key, $default = null)
  {
    return $this->get(self::TYPE_WARNING, $key, $default);
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function setWarning($key, $value)
  {
    return $this->set(self::TYPE_WARNING, $key, $value);
  }

  /**
   * @param $key
   * @return bool
   */
  public function hasWarning($key)
  {
    return $this->has(self::TYPE_WARNING, $key);
  }

  /**
   * @return bool
   */
  public function hasAnyWarning()
  {
    return $this->hasAny(self::TYPE_WARNING);
  }

  /**
   * @return array
   */
  public function getAllWarning()
  {
    return $this->getAll(self::TYPE_WARNING);
  }

  /**
   * @param $key
   * @return $this
   */
  public function removeWarning($key)
  {
    return $this->remove(self::TYPE_WARNING, $key);
  }

  /**
   * @return $this
   */
  public function removeAllWWarning()
  {
    return $this->removeAll(self::TYPE_WARNING);
  }

  /**
   * @param $key
   * @param $default
   * @return mixed
   */
  public function getSuccess($key, $default = null)
  {
    return $this->get(self::TYPE_SUCCESS, $key, $default);
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function setSuccess($key, $value)
  {
    return $this->set(self::TYPE_SUCCESS, $key, $value);
  }

  /**
   * @param $key
   * @return bool
   */
  public function hasSuccess($key)
  {
    return $this->has(self::TYPE_SUCCESS, $key);
  }

  /**
   * @return bool
   */
  public function hasAnySuccess()
  {
    return $this->hasAny(self::TYPE_SUCCESS);
  }

  /**
   * @return array
   */
  public function getAllSuccess()
  {
    return $this->getAll(self::TYPE_SUCCESS);
  }

  /**
   * @param $key
   * @return $this
   */
  public function removeSuccess($key)
  {
    return $this->remove(self::TYPE_SUCCESS, $key);
  }

  /**
   * @return $this
   */
  public function removeAllSuccess()
  {
    return $this->removeAll(self::TYPE_SUCCESS);
  }

  /**
   * @param $key
   * @param $default
   * @return mixed
   */
  public function getInfo($key, $default = null)
  {
    return $this->get(self::TYPE_INFO, $key, $default);
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function setInfo($key, $value)
  {
    return $this->set(self::TYPE_INFO, $key, $value);
  }

  /**
   * @param $key
   * @return bool
   */
  public function hasInfo($key)
  {
    return $this->has(self::TYPE_INFO, $key);
  }

  /**
   * @return bool
   */
  public function hasAnyInfo()
  {
    return $this->hasAny(self::TYPE_INFO);
  }

  /**
   * @return array
   */
  public function getAllInfo()
  {
    return $this->getAll(self::TYPE_INFO);
  }

  /**
   * @param $key
   * @return $this
   */
  public function removeInfo($key)
  {
    return $this->remove(self::TYPE_INFO, $key);
  }

  /**
   * @return $this
   */
  public function removeAllInfo()
  {
    return $this->removeAll(self::TYPE_INFO);
  }
  
}