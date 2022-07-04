<?php

// autoload all required classes and + start a session;

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});


// + start a session;
session_start();
