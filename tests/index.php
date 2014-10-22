<?php
use JoeFallon\KissTest\UnitTest;

require('config/main.php');


new \tests\JoeFallon\Session\SessionTests();

UnitTest::getAllUnitTestsSummary();