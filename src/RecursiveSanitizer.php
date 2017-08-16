<?php

namespace Czerny;

class RecursiveSanitizer {
  private $sanitizer;

  public function __construct(callable $sanitizer) {
    $this->sanitizer = $sanitizer;
  }

  public function execute($input) {
    if (is_array($input)) {
      return array_map([$this, 'execute'], $input);
    }

    return call_user_func($this->sanitizer, $input);
  }
}
