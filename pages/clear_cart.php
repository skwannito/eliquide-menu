<?php
session_start();

// Effacer les données de la session du panier
unset($_SESSION['panier']);
