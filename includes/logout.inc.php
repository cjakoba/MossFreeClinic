<?php

session_start();
session_unset();
session_destroy();

// Go back to front page
header("location: ../index.php");
