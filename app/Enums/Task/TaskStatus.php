<?php

namespace App\Enums\Task;

enum TaskStatus: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';
}
