<?php
// Clear all session
session_destroy();
// Starting new session to save success message
session_start();
$notice->addSuccess("Successfully logout !");
header("location:".HTTP."?page=login");