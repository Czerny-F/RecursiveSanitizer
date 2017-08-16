<?php

namespace Czerny;

use PHPUnit\Framework\TestCase;

class RecursiveUnkotizerTest extends TestCase {

  public function setUp() {
    $this->trimmer = new RecursiveSanitizer(function() { return 'unko'; });
  }

  public function testTrimmerWithString() {
    $this->assertEquals('unko', $this->trimmer->execute(' foo '));
  }

  public function testTrimmerWithArray() {
    $this->assertEquals(
      ['unko', 'unko', 'unko'],
      $this->trimmer->execute([' foo', 'bar ', ' baz '])
    );
  }

  public function testTrimmerWithAssocArray() {
    $this->assertEquals(
      ['foo' => 'unko', ' baz ' => 'unko'],
      $this->trimmer->execute(['foo' => ' bar ', ' baz ' => '    hoge   '])
    );
  }

  public function testTrimmerWithMultiDimensionalArray() {
    $this->assertEquals(
      ['unko', ['unko', 'unko'], ['unko', ['unko', 'unko']]],
      $this->trimmer->execute(
        [' foo', ['bar ', ' baz '], ['  hoge ', ['   hogehoge   ', ' hoge hoge  ']]]
      )
    );
  }
}
