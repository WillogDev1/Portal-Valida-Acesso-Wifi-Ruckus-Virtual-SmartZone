<?php
// app/Session/SessionManager.php

namespace App\Session;

class SessionManager
{
    public static function startSession()
    {
        if 
        (
            session_status() == PHP_SESSION_NONE) 
            {
                session_start();
            }
    }

    public static function endSession()
    {
        // Finaliza Sessão
        session_destroy();
    }

}
?>