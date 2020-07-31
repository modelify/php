<?php

namespace MockAPI\Model;

use Modelify\Tests\Cases\MockAPITestCase;
use Modelify\Tests\Classes\MockAPI\Model\Content;

class ContentTest extends MockAPITestCase {

  public function testCanInstantiate() {
    $content = $this->instance()->content();
    $this->assertInstanceOf(Content::class, $content);
  }

  public function testCanListContents() {
    $content = $this->instance()->content()->all();
    $this->assertIsArray($content);
    // $this->assertInstanceOf(Content::class, $content);
  }

  public function testCanCreateContent() {
    $content = $this->instance()->content();

    $content = $content->create([
      'name' => 'Christian Ezeani',
      'username' => 'christianezeani',
      'email' => 'christianezeani@demo.com'
    ]);

    $this->assertInstanceOf(Content::class, $content);

    return $content->id;
  }

  /**
   * @depends testCanCreateContent
   */
  public function testCanGetContent($id) {
    $content = $this->instance()->content()->get($id);

    $this->assertInstanceOf(Content::class, $content);

    return $content;
  }

  /**
   * @depends testCanGetContent
   */
  public function testCanEditContent($content) {
    $content = $content->edit;

    $this->assertInstanceOf(Content::class, $content);

    return $content;
  }

  /**
   * @depends testCanEditContent
   */
  public function testCanDeleteContent($content) {
    $content = $content->delete();
    $this->assertInstanceOf(Content::class, $content);
  }

}
