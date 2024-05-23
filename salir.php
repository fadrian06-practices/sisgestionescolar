<?php

session_start();
unset($_SESSION['user.id']);
header('location: ./ingreso');
