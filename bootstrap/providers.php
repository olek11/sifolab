<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\CompilerInterface;

class DisableViewCacheProvider extends ServiceProvider
{
    public function register(): void
    {
        // Override compiler to disable compiled views
        $this->app->extend(CompilerInterface::class, function ($compiler, $app) {
            $compiler->setCompiledPath(null);
            return $compiler;
        });
    }
}
