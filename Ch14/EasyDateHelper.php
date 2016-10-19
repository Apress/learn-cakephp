<?php

namespace App\View\Helper;

use Cake\View\Helper;

class EasyDateHelper extends Helper
{
    public function add($days)
    {
        return 'D: ' . date('Y-m-d', mktime(0, 0, 0, 1, $days, 2000));
    }
}