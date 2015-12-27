<?php
namespace JoeFallon\PhpSession;

use InvalidArgumentException;

class Session
{
    const HOUR = 3600;
    const DAY  = 86400;
    const WEEK = 604800;

    /** @var int */
    private $_maxAgeInSecs;
    /** @var int */
    private $_lastActivityTimeoutInSecs;

    /**
     * @param int $maxAgeInSecs       All session entries expire in $maxAgeInSecs regardless of
     *                                whether or not the session has been read/written. To
     *                                prevent the session from expiring when the $maxAgeInSecs has
     *                                passed, set $maxAgeInSecs to zero (0). The value of
     *                                $maxAgeInSecs must be greater than or equal to
     *                                $lastActivityInSecs.
     * @param int $lastActivityInSecs Session entries expire when the time between session accesses
     *                                exceeds $lastActivityInSecs. To prevent the session from
     *                                expiring when $lastActivityInSecs has passed, set it to
     *                                zero (0).
     *
     * @throws InvalidArgumentException
     */
    public function __construct($maxAgeInSecs = self::HOUR, $lastActivityInSecs = self::HOUR)
    {
        $maxAgeInSecs       = intval($maxAgeInSecs);
        $lastActivityInSecs = intval($lastActivityInSecs);

        if($maxAgeInSecs < 0)
        {
            $msg = 'The session max age is less than zero.';
            throw new InvalidArgumentException($msg);
        }

        if($lastActivityInSecs < 0)
        {
            $msg = 'The session last activity timeout is less than zero.';
            throw new InvalidArgumentException($msg);
        }

        if($maxAgeInSecs < $lastActivityInSecs)
        {
            $msg = 'The session max age must be longer than last activity timeout.';
            throw new InvalidArgumentException($msg);
        }

        $this->_maxAgeInSecs              = $maxAgeInSecs;
        $this->_lastActivityTimeoutInSecs = $lastActivityInSecs;
    }


    /**
     * Retrieve the session value associated with the key.
     *
     * @param string $key Session key.
     *
     * @return mixed
     */
    public function read($key)
    {
        $key = strval($key);
        $val = null;

        if(strlen($key) == 0)
        {
            return $val;
        }

        $this->openSession();

        if(isset($_SESSION[$key]) == true)
        {
            $val = $_SESSION[$key];
        }

        $this->closeSession();

        return $val;
    }

    private function openSession()
    {
        session_start();
        session_regenerate_id();
        $_SESSION['session_last_activity_time'] = time();
    }

    private function closeSession()
    {
        session_write_close();
    }

    /**
     * Writes a session value to the session.
     *
     * @param string $key Key to store the session value in.
     * @param string $val Value to be stored.
     *
     * @throws InvalidArgumentException
     */
    public function write($key, $val)
    {
        $key = strval($key);

        if(strlen($key) == 0)
        {
            $msg = 'The key cannot be empty.';
            throw new InvalidArgumentException($msg);
        }

        $this->openSession();
        $_SESSION[$key] = $val;
        $this->closeSession();
    }

    /**
     * Unset the specified session variable.
     *
     * @param string $key Session key.
     */
    public function unsetSessionValue($key)
    {
        $key = strval($key);

        $this->openSession();
        unset($_SESSION[$key]);
        $this->closeSession();
    }

    /**
     * @return boolean Returns true if the time limit between now and the time that the session was
     *                 started has been exceeded.
     */
    public function isMaxAgeTimeoutExpired()
    {
        if($this->_maxAgeInSecs == 0)
        {
            return false;
        }

        $this->openSession();

        if(!isset($_SESSION['session_created_time']))
        {
            $_SESSION['session_created_time'] = time();
            $this->closeSession();

            return false;
        }
        else
        {
            $now     = time();
            $created = intval($_SESSION['session_created_time']);
            $max     = $this->_maxAgeInSecs;
            $diff    = $now - $created;

            if($diff >= $max)
            {
                $this->closeSession();

                return true;
            }

            $this->closeSession();

            return false;
        }
    }

    /**
     * @return boolean Returns true if the time limit between now and the last activity has been
     *                 exceeded.
     */
    public function isLastActivityTimeoutExpired()
    {
        if($this->_lastActivityTimeoutInSecs == 0)
        {
            return false;
        }

        $this->openSession();

        if(!isset($_SESSION['session_last_activity_time']))
        {
            $_SESSION['session_last_activity_time'] = time();
            $this->closeSession();

            return false;
        }
        else
        {
            $now          = time();
            $lastActivity = intval($_SESSION['session_last_activity_time']);
            $max          = $this->_lastActivityTimeoutInSecs;
            $diff         = $now - $lastActivity;
            $this->closeSession();

            if($diff >= $max)
            {
                return true;
            }

            return false;
        }

    }

    /**
     * Completely eliminate all session data.
     */
    public function destroy()
    {
        session_start();

        if(ini_get("session.use_cookies"))
        {
            $params = session_get_cookie_params();
            setcookie(session_name(),
                      '',
                      time() - 42000,
                      $params["path"],
                      $params["domain"],
                      $params["secure"],
                      $params["httponly"]
            );
        }

        session_unset();
        session_regenerate_id(true);
        session_destroy();
        session_write_close();
    }
}
