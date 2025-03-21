<?php

declare(strict_types=1);

namespace App\Bootstrap;

use App\Config;
use App\Exceptions\ErrorHandler;
use DI\Container;
use Slim\App;

class ExceptionManager
{
    /** @param App<Container> $app */
    public function __construct(
        private App $app,
        private Config $config
    ) {}

    /** Set up and configure exception handling. */
    public function __invoke(): void
    {
        if ($this->config->get('debug')) {
            return;
        }

        $errorMiddleware = $this->app->addErrorMiddleware(true, true, true);
        $errorMiddleware->setDefaultErrorHandler(ErrorHandler::class);
    }
}
