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

  public function testCustomTypeAndDiscard()
  {
    $this->assertFalse($this->flash->has("custom", "foo"));
    $this->assertFalse($this->flash->hasAny("custom"));
    $this->assertEquals("bar", $this->flash->get("custom", "foo", "bar"));
    $this->assertNull($this->flash->get("custom", "foo"));

    $this->assertEmpty($this->flash->getAllTypes());
    $this->assertEmpty($this->flash->getAll("custom"));

    $this->flash->set("custom", "foo", "bar");

    $this->flash = new FlashMessages($this->storage, $this->key);
    $this->assertArrayHasKey($this->key, $this->storage);
    $this->assertEmpty($this->storage[$this->key]);

    $this->assertEquals(["custom" => ["foo" => "bar"]], $this->flash->getAllTypes());
    $this->assertEquals(["foo" => "bar"], $this->flash->getAll("custom"));

    $this->assertTrue($this->flash->has("custom", "foo"));
    $this->assertTrue($this->flash->hasAny("custom"));
    $this->assertEquals("bar", $this->flash->get("custom", "foo"));

    $this->flash->set("custom", "foo", "bar");
    $this->assertArrayHasKey("custom", $this->storage[$this->key]);
    $this->assertEquals("bar", $this->storage[$this->key]["custom"]["foo"]);
    $this->flash->remove("custom", "foo");
    $this->assertArrayNotHasKey("foo", $this->storage[$this->key]["custom"]);

    $this->flash = new FlashMessages($this->storage, $this->key);

    $this->assertFalse($this->flash->has("custom", "foo"));
    $this->assertNull($this->flash->get("custom", "foo"));
  }

  public function testError()
  {
    $this->assertEmpty($this->flash->getAllError());
    $this->assertNull($this->flash->getError("foo"));
    $this->assertEquals("bar", $this->flash->getError("foo", "bar"));
    $this->assertFalse($this->flash->hasAnyError());

    $this->flash->setError("foo", "bar");

    $this->flash = new FlashMessages($this->storage, $this->key);

    $this->assertEquals(["foo" => "bar"], $this->flash->getAllError());
    $this->assertEquals("bar", $this->flash->getError("foo"));
    $this->assertTrue($this->flash->hasAnyError());

    $this->flash->setError("foo", "bar");
    $this->flash->setError("foo2", "bar2");
    $this->assertArrayHasKey("error", $this->storage[$this->key]);
    $this->assertEquals("bar", $this->storage[$this->key]["error"]["foo"]);
    $this->flash->removeError("foo");
    $this->assertArrayNotHasKey("foo", $this->storage[$this->key]["error"]);
    $this->assertNotEmpty($this->storage[$this->key]["error"]);
    $this->flash->removeAllError();
    $this->assertEmpty($this->storage[$this->key]["error"]);
  }

  public function testWarning()
  {
    $this->assertEmpty($this->flash->getAllWarning());
    $this->assertNull($this->flash->getWarning("foo"));
    $this->assertEquals("bar", $this->flash->getWarning("foo", "bar"));
    $this->assertFalse($this->flash->hasAnyWarning());

    $this->flash->setWarning("foo", "bar");

    $this->flash = new FlashMessages($this->storage, $this->key);

    $this->assertEquals(["foo" => "bar"], $this->flash->getAllWarning());
    $this->assertEquals("bar", $this->flash->getWarning("foo"));
    $this->assertTrue($this->flash->hasAnyWarning());

    $this->flash->setWarning("foo", "bar");
    $this->flash->setWarning("foo2", "bar2");
    $this->assertArrayHasKey("warning", $this->storage[$this->key]);
    $this->assertEquals("bar", $this->storage[$this->key]["warning"]["foo"]);
    $this->flash->removeWarning("foo");
    $this->assertArrayNotHasKey("foo", $this->storage[$this->key]["warning"]);
    $this->assertNotEmpty($this->storage[$this->key]["warning"]);
    $this->flash->removeAllWWarning();
    $this->assertEmpty($this->storage[$this->key]["warning"]);
  }

  public function testSuccess()
  {
    $this->assertEmpty($this->flash->getAllSuccess());
    $this->assertNull($this->flash->getSuccess("foo"));
    $this->assertEquals("bar", $this->flash->getSuccess("foo", "bar"));
    $this->assertFalse($this->flash->hasAnySuccess());

    $this->flash->setSuccess("foo", "bar");

    $this->flash = new FlashMessages($this->storage, $this->key);

    $this->assertEquals(["foo" => "bar"], $this->flash->getAllSuccess());
    $this->assertEquals("bar", $this->flash->getSuccess("foo"));
    $this->assertTrue($this->flash->hasAnySuccess());

    $this->flash->setSuccess("foo", "bar");
    $this->flash->setSuccess("foo2", "bar2");
    $this->assertArrayHasKey("success", $this->storage[$this->key]);
    $this->assertEquals("bar", $this->storage[$this->key]["success"]["foo"]);
    $this->flash->removeSuccess("foo");
    $this->assertArrayNotHasKey("foo", $this->storage[$this->key]["success"]);
    $this->assertNotEmpty($this->storage[$this->key]["success"]);
    $this->flash->removeAllSuccess();
    $this->assertEmpty($this->storage[$this->key]["success"]);
  }

  public function testInfo()
  {
    $this->assertEmpty($this->flash->getAllInfo());
    $this->assertNull($this->flash->getInfo("foo"));
    $this->assertEquals("bar", $this->flash->getInfo("foo", "bar"));
    $this->assertFalse($this->flash->hasAnyInfo());

    $this->flash->setInfo("foo", "bar");

    $this->flash = new FlashMessages($this->storage, $this->key);

    $this->assertEquals(["foo" => "bar"], $this->flash->getAllInfo());
    $this->assertEquals("bar", $this->flash->getInfo("foo"));
    $this->assertTrue($this->flash->hasAnyInfo());

    $this->flash->setInfo("foo", "bar");
    $this->flash->setInfo("foo2", "bar2");
    $this->assertArrayHasKey("info", $this->storage[$this->key]);
    $this->assertEquals("bar", $this->storage[$this->key]["info"]["foo"]);
    $this->flash->removeInfo("foo");
    $this->assertArrayNotHasKey("foo", $this->storage[$this->key]["info"]);
    $this->assertNotEmpty($this->storage[$this->key]["info"]);
    $this->flash->removeAllInfo();
    $this->assertEmpty($this->storage[$this->key]["info"]);
  }

}