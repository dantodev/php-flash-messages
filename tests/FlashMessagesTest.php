<?php namespace Dtkahl\FlashMessages;

class FlashMessagesTest extends \PHPUnit_Framework_TestCase {

  private $storage = [];
  private $key = "test_key";

  /** @var FlashMessages */
  private $flash;

  public function setUp()
  {
    $this->flash = new FlashMessages($this->storage, $this->key);
  }

  public function testBasic()
  {
    $this->assertArrayHasKey($this->key, $this->storage);
  }

  public function testGetEmpty()
  {
    $this->assertFalse($this->flash->has("foo"));
    $this->assertEquals("bar", $this->flash->get("foo", "bar"));
    $this->assertNull($this->flash->get("foo"));
  }

  public function testSetRemove()
  {
    $this->flash->set("foo", "bar");
    $this->assertEquals("bar", $this->storage[$this->key]["foo"]);
    $this->flash->remove("foo");
    $this->assertArrayNotHasKey("foo", $this->storage[$this->key]);
  }

  public function testTransferGetDiscard()
  {
    $this->flash->set("foo", "bar");

    $this->flash = new FlashMessages($this->storage, $this->key);
    $this->assertArrayHasKey($this->key, $this->storage);
    $this->assertEmpty($this->storage[$this->key]);

    $this->assertTrue($this->flash->has("foo"));
    $this->assertEquals("bar", $this->flash->get("foo"));

    $this->flash = new FlashMessages($this->storage, $this->key);

    $this->assertFalse($this->flash->has("foo"));
    $this->assertNull($this->flash->get("foo"));
  }

}