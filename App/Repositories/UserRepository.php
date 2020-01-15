<?php

namespace App\Repositories;

use App\Core\DB\PDORepository;
use PDO;

class UserRepository extends PDORepository
{
    protected $table = 'usuarios';
}