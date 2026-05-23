<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Session_write_close Hook
 *
 * Fires after every controller constructor but before the method executes.
 * Releases the PHP session file lock so parallel AJAX requests on the same
 * page are not forced to queue behind long-running dashboard/datatables calls.
 *
 * If a controller method needs to write session data after this point, call
 * session_start() to reopen the session before writing.
 */
class Session_write_close
{
    public function close()
    {
        // Release the session lock for ALL requests immediately after the constructor.
        // Session data needed by controller methods (login, logout) must call
        // session_start() before writing — see authenctication.php and login_admin.php.
        session_write_close();
    }
}
