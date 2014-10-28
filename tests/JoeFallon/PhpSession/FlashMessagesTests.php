<?php
namespace tests\JoeFallon\PhpSession;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\PhpSession\FlashMessages;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 */
class FlashMessagesTests extends UnitTest
{
    public function test_ctor_properly_initializes_instance()
    {
        $flash           = new FlashMessages();
        $errorMessages   = $flash->retrieveErrorMessages();
        $infoMessages    = $flash->retrieveInfoMessages();
        $successMessages = $flash->retrieveSuccessMessages();
        $warningMessages = $flash->retrieveWarningMessages();

        $this->assertEqual($errorMessages,   null, '$errorMessages');
        $this->assertEqual($infoMessages,    null, '$infoMessages');
        $this->assertEqual($successMessages, null, '$successMessages');
        $this->assertEqual($warningMessages, null, '$warningMessages');
    }

    public function test_store_local_error_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeErrorMessage('test_err_msg', 'test error message');

        $out1 = $flash->retrieveErrorMessage('test_err_msg');
        $this->assertEqual($out1, 'test error message');

        $out2 = $flash->retrieveErrorMessage('test_err_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_local_info_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeInfoMessage('test_info_msg', 'test info message');

        $out1 = $flash->retrieveInfoMessage('test_info_msg');
        $this->assertEqual($out1, 'test info message');

        $out2 = $flash->retrieveInfoMessage('test_info_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_local_success_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeSuccessMessage('test_success_msg', 'test success message');

        $out1 = $flash->retrieveSuccessMessage('test_success_msg');
        $this->assertEqual($out1, 'test success message');

        $out2 = $flash->retrieveSuccessMessage('test_success_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_local_warning_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeWarningMessage('test_warn_msg', 'test warn message');

        $out1 = $flash->retrieveWarningMessage('test_warn_msg');
        $this->assertEqual($out1, 'test warn message');

        $out2 = $flash->retrieveWarningMessage('test_warn_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_session_error_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeErrorMessage('test_err_msg', 'test error message', true);

        $out1 = $flash->retrieveErrorMessage('test_err_msg');
        $this->assertEqual($out1, 'test error message');

        $out2 = $flash->retrieveErrorMessage('test_err_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_session_info_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeInfoMessage('test_info_msg', 'test info message', true);

        $out1 = $flash->retrieveInfoMessage('test_info_msg');
        $this->assertEqual($out1, 'test info message');

        $out2 = $flash->retrieveInfoMessage('test_info_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_session_success_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeSuccessMessage('test_success_msg', 'test success message', true);

        $out1 = $flash->retrieveSuccessMessage('test_success_msg');
        $this->assertEqual($out1, 'test success message');

        $out2 = $flash->retrieveSuccessMessage('test_success_msg');
        $this->assertEqual($out2, null);
    }

    public function test_store_session_warning_message_is_retrieve_by_key_and_deleted()
    {
        $flash = new FlashMessages();
        $flash->storeWarningMessage('test_warn_msg', 'test warn message', true);

        $out1 = $flash->retrieveWarningMessage('test_warn_msg');
        $this->assertEqual($out1, 'test warn message');

        $out2 = $flash->retrieveWarningMessage('test_warn_msg');
        $this->assertEqual($out2, null);
    }

    public function test_retrieveErrorMessages_retrieves_msgs_and_deletes()
    {
        $flash = new FlashMessages();
        $flash->storeErrorMessage('test_err_msg1', 'test error message1');
        $flash->storeErrorMessage('test_err_msg2', 'test error message2', true);

        $out1 = $flash->retrieveErrorMessages();
        $this->assertEqual(count($out1), 2);

        $out2 = $flash->retrieveErrorMessages();
        $this->assertEqual($out2, null);
    }

    public function test_retrieveInfoMessages_retrieves_msgs_and_deletes()
    {
        $flash = new FlashMessages();
        $flash->storeInfoMessage('test_info_msg1', 'test info message1');
        $flash->storeInfoMessage('test_info_msg2', 'test info message2', true);

        $out1 = $flash->retrieveInfoMessages();
        $this->assertEqual(count($out1), 2);

        $out2 = $flash->retrieveInfoMessages();
        $this->assertEqual($out2, null);
    }

    public function test_retrieveSuccessMessages_retrieves_msgs_and_deletes()
    {
        $flash = new FlashMessages();
        $flash->storeSuccessMessage('test_success_msg1', 'test success message1');
        $flash->storeSuccessMessage('test_success_msg2', 'test success message2', true);

        $out1 = $flash->retrieveSuccessMessages();
        $this->assertEqual(count($out1), 2);

        $out2 = $flash->retrieveSuccessMessages();
        $this->assertEqual($out2, null);
    }

    public function test_retrieveWarningMessages_retrieves_msgs_and_deletes()
    {
        $flash = new FlashMessages();
        $flash->storeWarningMessage('test_warn_msg1', 'test warn message1');
        $flash->storeWarningMessage('test_warn_msg2', 'test warn message2', true);

        $out1 = $flash->retrieveWarningMessages();
        $this->assertEqual(count($out1), 2, 'count');

        $out2 = $flash->retrieveWarningMessages();
        $this->assertEqual($out2, null, 'null check');
    }
}