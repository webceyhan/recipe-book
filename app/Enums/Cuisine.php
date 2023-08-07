<?php

namespace App\Enums;

enum Cuisine: string
{
    use Traits\HasBase;

    case American = 'American';
    case Italian = 'Italian';
    case Mexican = 'Mexican';
    case Chinese = 'Chinese';
    case Japanese = 'Japanese';
    case Korean = 'Korean';
    case Indian = 'Indian';
    case French = 'French';
    case Other = 'Other';
}
