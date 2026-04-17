<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Teacher = 'teacher';
    case Student = 'student';
}
