<?php
namespace JoeFallon\PhpSession;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class FlashMessages
{
    /** @var  array */
    private $_infoMessages;
    /** @var  array */
    private $_warningMessages;
    /** @var  array */
    private $_successMessages;
    /** @var  array */
    private $_errorMessages;


    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->_infoMessages    = array();
        $this->_warningMessages = array();
        $this->_successMessages = array();
        $this->_errorMessages   = array();
    }


    /**
     * This function stores the informational flash message. If $storeInSession
     * is set to true, then the message is stored in the session. Otherwise, it
     * is stored locally.
     *
     * @param string  $key
     * @param string  $msg
     * @param bool    $storeInSession
     */
    public function storeInfoMessage($key, $msg, $storeInSession = false)
    {
        if($storeInSession == false)
        {
            if(strlen($key) > 0)
            {
                $this->_infoMessages[$key] = $msg;
            }
            else
            {
                $this->_infoMessages[] = $msg;
            }
        }
        else
        {
            $sess = new Session();
            $infos = $sess->read('flash_infos');

            if(is_array($infos) == false)
            {
                $infos = array();
            }

            if(strlen($key) > 0)
            {
                $infos[$key] = $msg;
            }
            else
            {
                $infos[] = $msg;
            }

            $sess->write('flash_infos', $infos);
        }
    }


    /**
     * This function returns an array of all info messages. Additionally,
     * it deletes all of the info messages.
     *
     * @return array
     */
    public function retrieveInfoMessages()
    {
        $msgsLocal = $this->_infoMessages;
        $this->_infoMessages = array();

        $sess = new Session();
        $msgsSession = $sess->read('flash_infos');
        $sess->unsetSessionValue('flash_infos');

        if(is_array($msgsSession) == false)
        {
            $msgsSession = array();
        }

        $msgs = array_merge($msgsLocal, $msgsSession);

        if(count($msgs) == 0)
        {
            return null;
        }

        return $msgs;
    }


    /**
     * This function returns the info message specified by $key. Addiitonally,
     * it deletes the specified info message from the flass message store.
     *
     * @param $key
     * @return string
     */
    public function retrieveInfoMessage($key)
    {
        if(array_key_exists($key, $this->_infoMessages) == true)
        {
            $msg = $this->_infoMessages[$key];
            unset($this->_infoMessages[$key]);

            return $msg;
        }

        $sess = new Session();
        $infos = $sess->read('flash_infos');

        if(is_array($infos) && array_key_exists($key, $infos) == true)
        {
            $msg = $infos[$key];
            unset($infos[$key]);

            $sess->write('flash_infos', $infos);

            return $msg;
        }

        return null;
    }


    /**
     * This function stores the success flash message. If $storeInSession
     * is set to true, then the message is stored in the session. Otherwise, it
     * is stored locally.
     *
     * @param string  $key
     * @param string  $msg
     * @param bool    $storeInSession
     */
    public function storeSuccessMessage($key, $msg, $storeInSession = false)
    {
        if($storeInSession == false)
        {
            if(strlen($key) > 0)
            {
                $this->_successMessages[$key] = $msg;
            }
            else
            {
                $this->_successMessages[] = $msg;
            }
        }
        else
        {
            $sess = new Session();
            $successes = $sess->read('flash_successes');

            if(is_array($successes) == false)
            {
                $successes = array();
            }

            if(strlen($key) > 0)
            {
                $successes[$key] = $msg;
            }
            else
            {
                $successes[] = $msg;
            }

            $sess->write('flash_successes', $successes);
        }
    }


    /**
     * This function returns an array of all success messages. Additionally,
     * it deletes all of the success messages.
     *
     * @return array
     */
    public function retrieveSuccessMessages()
    {
        $msgsLocal = $this->_successMessages;
        $this->_successMessages = array();

        $sess = new Session();
        $msgsSession = $sess->read('flash_successes');
        $sess->unsetSessionValue('flash_successes');

        if(is_array($msgsSession) == false)
        {
            $msgsSession = array();
        }

        $msgs = array_merge($msgsLocal, $msgsSession);

        if(count($msgs) == 0)
        {
            return null;
        }

        return $msgs;
    }


    /**
     * This function returns the success message specified by $key. Addiitonally,
     * it deletes the specified success message from the flass message store.
     *
     * @param $key
     * @return string
     */
    public function retrieveSuccessMessage($key)
    {
        if(array_key_exists($key, $this->_successMessages) == true)
        {
            $msg = $this->_successMessages[$key];
            unset($this->_successMessages[$key]);

            return $msg;
        }

        $sess = new Session();
        $successes = $sess->read('flash_successes');

        if(is_array($successes) && array_key_exists($key, $successes) == true)
        {
            $msg = $successes[$key];
            unset($successes[$key]);

            $sess->write('flash_successes', $successes);

            return $msg;
        }

        return null;
    }


    /**
     * This function stores the warning flash message. If $storeInSession
     * is set to true, then the message is stored in the session. Otherwise, it
     * is stored locally.
     *
     * @param string  $key
     * @param string  $msg
     * @param bool    $storeInSession
     */
    public function storeWarningMessage($key, $msg, $storeInSession = false)
    {
        if($storeInSession == false)
        {
            if(strlen($key) > 0)
            {
                $this->_warningMessages[$key] = $msg;
            }
            else
            {
                $this->_warningMessages[] = $msg;
            }
        }
        else
        {
            $sess = new Session();
            $warnings = $sess->read('flash_warnings');

            if(is_array($warnings) == false)
            {
                $warnings = array();
            }

            if(strlen($key) > 0)
            {
                $warnings[$key] = $msg;
            }
            else
            {
                $warnings[] = $msg;
            }

            $sess->write('flash_warnings', $warnings);
        }
    }


    /**
     * This function returns an array of all warning messages. Additionally,
     * it deletes all of the warning messages.
     *
     * @return array
     */
    public function retrieveWarningMessages()
    {
        $msgsLocal = $this->_warningMessages;
        $this->_warningMessages = array();

        $sess = new Session();
        $msgsSession = $sess->read('flash_warnings');
        $sess->unsetSessionValue('flash_warnings');

        if(is_array($msgsSession) == false)
        {
            $msgsSession = array();
        }

        $msgs = array_merge($msgsLocal, $msgsSession);

        if(count($msgs) == 0)
        {
            return null;
        }

        return $msgs;
    }


    /**
     * This function returns the warning message specified by $key. Addiitonally,
     * it deletes the specified warning message from the flass message store.
     *
     * @param $key
     * @return string
     */
    public function retrieveWarningMessage($key)
    {
        if(array_key_exists($key, $this->_warningMessages) == true)
        {
            $msg = $this->_warningMessages[$key];
            unset($this->_warningMessages[$key]);

            return $msg;
        }

        $sess = new Session();
        $warnings = $sess->read('flash_warnings');

        if(is_array($warnings) && array_key_exists($key, $warnings) == true)
        {
            $msg = $warnings[$key];
            unset($warnings[$key]);

            $sess->write('flash_warnings', $warnings);

            return $msg;
        }

        return null;
    }


    /**
     * This function stores the error flash message. If $storeInSession
     * is set to true, then the message is stored in the session. Otherwise, it
     * is stored locally.
     *
     * @param string  $key
     * @param string  $msg
     * @param bool    $storeInSession
     */
    public function storeErrorMessage($key, $msg, $storeInSession = false)
    {
        if($storeInSession == false)
        {
            if(strlen($key) > 0)
            {
                $this->_errorMessages[$key] = $msg;
            }
            else
            {
                $this->_errorMessages[] = $msg;
            }
        }
        else
        {
            $sess = new Session();
            $errors = $sess->read('flash_errors');

            if(is_array($errors) == false)
            {
                $errors = array();
            }

            if(strlen($key) > 0)
            {
                $errors[$key] = $msg;
            }
            else
            {
                $errors[] = $msg;
            }

            $sess->write('flash_errors', $errors);
        }
    }


    /**
     * This function returns an array of all error messages. Additionally,
     * it deletes all of the error messages.
     *
     * @return array
     */
    public function retrieveErrorMessages()
    {
        $msgsLocal = $this->_errorMessages;
        $this->_errorMessages = array();

        $sess = new Session();
        $msgsSession = $sess->read('flash_errors');
        $sess->unsetSessionValue('flash_errors');

        if(is_array($msgsSession) == false)
        {
            $msgsSession = array();
        }

        $msgs = array_merge($msgsLocal, $msgsSession);

        if(count($msgs) == 0)
        {
            return null;
        }

        return $msgs;
    }


    /**
     * This function returns the error message specified by $key. Addiitonally,
     * it deletes the specified error message from the flass message store.
     *
     * @param $key
     * @return string
     */
    public function retrieveErrorMessage($key)
    {
        if(array_key_exists($key, $this->_errorMessages) == true)
        {
            $msg = $this->_errorMessages[$key];
            unset($this->_errorMessages[$key]);

            return $msg;
        }

        $sess = new Session();
        $errors = $sess->read('flash_errors');

        if(is_array($errors) && array_key_exists($key, $errors) == true)
        {
            $msg = $errors[$key];
            unset($errors[$key]);

            $sess->write('flash_errors', $errors);

            return $msg;
        }

        return null;
    }
}