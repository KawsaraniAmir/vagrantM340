<?php

// carico il file di configurazione
require 'application/config/config.php';

// carico le classi dell'applicazione
require 'vendor/autoload.php';

// faccio partire l'applicazione
$app = new Application();
