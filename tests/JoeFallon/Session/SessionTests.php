<?php
namespace tests\JoeFallon\Session;

use Exception;
use JoeFallon\KissTest\UnitTest;
use JoeFallon\Session\Session;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class SessionTests extends UnitTest
{
    public function test_negative_maxAgeInSecs_values_throws_exception()
    {
        try
        {
            $session = new Session(-1, 1800);
        }
        catch(Exception $e)
        {
            $e = null;
            $this->testPass();

            return;
        }

        $this->testFail();

        return;
    }

    public function test_negative_lastActivityTimeoutInSecs_values_throws_exception()
    {
        try
        {
            $session = new Session(1800, -1);
        }
        catch(Exception $e)
        {
            $e = null;
            $this->testPass();

            return;
        }

        $this->testFail();

        return;
    }

    public function test_smaller_maxAgeInSecs_values_throws_exception()
    {
        try
        {
            $session = new Session(1800, 1801);
        }
        catch(Exception $e)
        {
            $e = null;
            $this->testPass();

            return;
        }

        $this->testFail();

        return;
    }

    public function test_write_throws_exception_if_key_empty()
    {
        try
        {
            $session = new Session();
            $session->write(null, 'foo');
        }
        catch(Exception $e)
        {
            $e = null;
            $this->testPass();

            return;
        }

        $this->testFail();

        return;
    }

    public function test_read_returns_null_if_key_empty()
    {
        $session  = new Session();
        $actual   = $session->read(null);
        $expected = null;

        $this->assertEqual($actual, $expected);

        $session->destroy();
    }

    public function test_read_write()
    {
        $foo     = 'bar';
        $session = new Session();

        $expected = null;
        $actual   = $session->read($foo);

        $this->assertEqual($actual, $expected);

        $expected = 'random value';
        $session->write($foo, $expected);
        $actual = $session->read($foo);

        $this->assertEqual($actual, $expected);

        $session->destroy();
    }

    public function test_unset()
    {
        $foo     = 'bar';
        $session = new Session();

        $session->write($foo, 'random value');
        $session->unsetSessionValue($foo);

        $expected = null;
        $actual   = $session->read($foo);

        $this->assertEqual($actual, $expected);

        $session->destroy();
    }
}