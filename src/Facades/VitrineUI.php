<?php

namespace A17\VitrineUI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \A17\VitrineUI\VitrineUI
 */
class VitrineUI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \A17\VitrineUI\VitrineUI::class;
    }
}
