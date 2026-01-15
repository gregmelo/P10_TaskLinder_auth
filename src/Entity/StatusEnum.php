<?php
// src/Entity/StatusEnum.php

namespace App\Entity;

// Utilisation d'un Enum natif (PHP 8.1+)
enum StatusEnum: string 
{
    case Todo = 'To Do';
    case Doing = 'Doing';
    case Done = 'Done';

    // Méthode utilitaire pour obtenir toutes les valeurs brutes (utile pour les formulaires)
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}