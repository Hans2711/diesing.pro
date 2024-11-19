<?php
namespace App\Utilities;

class SessionUtility
{
    public static function privateAreaAuthenticated() {
        $enable_time = session('private_enable_session');
        $compare_time = time() - 31556926;

        if (!empty($enable_time) && $enable_time > $compare_time) {
            return true;
        }
        return false;
    }

    public static function privateAreaAuthenticate() {
        session(['private_enable_session' => time()]);
    }

    public static function testerAuthenticated() {
        $enable_time = session('tester_enable_session');
        $compare_time = time() - 31556926;
        if (!empty($enable_time) && $enable_time > $compare_time) {
            return true;
        }
        return false;
    }

    public static function testerAuthenticate() {
        session(['tester_enable_session' => time()]);
    }

}
