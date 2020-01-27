<?php

session_start();
session_destroy();
header('Location: ../../vistas/base/principal.php');

