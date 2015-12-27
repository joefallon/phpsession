<?php
namespace tests\JoeFallon\PhpSession;

use Exception;
use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpSession\Session;

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
            $session = new Session(-1, Session::HOUR);
        }
        catch(Exception $ex)
        {
            $ex = null;
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
            $session = new Session(Session::HOUR, -1);
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
            $session = new Session(Session::HOUR, Session::HOUR + 1);
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
        $session = new Session();
        $this->assertEqual($session->read(null), null);

        $session->destroy();
    }

    public function test_read_write()
    {
        $session = new Session();
        $this->assertEqual($session->read('bar'), null);

        $session->write('bar', 'random value');
        $this->assertEqual($session->read('bar'), 'random value');

        $session->destroy();
    }

    public function test_unset()
    {
        $session = new Session();
        $session->write('bar', 'random value');
        $session->unsetSessionValue('bar');
        $this->assertEqual($session->read('bar'), null);
        
        $session->destroy();
    }
}
