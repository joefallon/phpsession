<?php
use JoeFallon\KissTest\UnitTest;

require('config/main.php');


new \tests\JoeFallon\PhpSession\SessionTests();

UnitTest::getAllUnitTestsSummary();
