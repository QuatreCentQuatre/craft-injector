<?php

namespace quatrecentquatre\injector\models;

use Craft;
use craft\base\Model;

/**
 * Injector settings
 */
class Settings extends Model
{
    public $scripts = [];

    public function defineRules(): array
    {
        return [];
    }
}
