<?php

namespace App\Enums;

// trzeba nadpisac to jakos wykorzystac - DO ZROBIENIA

class OrderStatus
{
    const IN_PROGRESS = 'in progress';
    const SENT = 'sent';

    const TYPES = [
        self::IN_PROGRESS,
        self::SENT
    ];
}
