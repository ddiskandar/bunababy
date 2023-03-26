<?php

test('sum', function () {
    $result = array_sum([1, 2]);

    expect($result)->toBe(3);
 });
