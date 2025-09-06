<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    public function show_exception($exception)
    {
        // Use plain HTML and relative URLs
        $message = nl2br($exception->getMessage());
        echo "<h1>An error occurred</h1>";
        echo "<p>{$message}</p>";
        echo "<p><a href='/'>Go back to Home</a></p>";
    }
}
