<?php

namespace Modbase\Disqus\Facades;

use Modbase\Disqus\Disqus;
use Illuminate\Support\Facades\Facade;

class DisqusSSO extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Disqus::class;
    }
}
