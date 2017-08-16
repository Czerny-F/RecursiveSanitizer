<?php

namespace Czerny;

use PHPUnit\Framework\TestCase;

class RecursiveSanitizerTest extends TestCase {

  public function setUp() {
    $this->trimmer = new RecursiveSanitizer('trim');
  }

  public function testTrimmerWithString() {
    $this->assertEquals('foo', $this->trimmer->execute(' foo '));
  }

  public function testTrimmerWithArray() {
    $this->assertEquals(
      ['foo', 'bar', 'baz'],
      $this->trimmer->execute([' foo', 'bar ', ' baz '])
    );
  }

  public function testTrimmerWithAssocArray() {
    $this->assertEquals(
      ['foo' => 'bar', ' baz ' => 'hoge'],
      $this->trimmer->execute(['foo' => ' bar ', ' baz ' => '    hoge   '])
    );
  }

  public function testTrimmerWithMultiDimensionalArray() {
    $this->assertEquals(
      ['foo', ['bar', 'baz'], ['hoge', ['hogehoge', 'hoge hoge']]],
      $this->trimmer->execute(
        [' foo', ['bar ', ' baz '], ['  hoge ', ['   hogehoge   ', ' hoge hoge  ']]]
      )
    );
  }
}
