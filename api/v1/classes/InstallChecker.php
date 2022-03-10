<?php

class InstallChecker
{
    public function __construct()
    {
        if (
            !file_exists(__DIR__.'/../../../assets/vendor/installed')
            || !file_exists(__DIR__.'/../../../assets/vendor/licensed')
        ) {
            header("location: /installation");
        }
    }

    public function installStatus()
    {
        if (
            file_exists(__DIR__.'/../../../assets/vendor/installed')
            && file_exists(__DIR__.'/../../../assets/vendor/licensed')
        ) {
            header("location: /");
        }
    }
}