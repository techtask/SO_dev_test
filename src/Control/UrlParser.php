<?php

namespace silverorange\DevTest\Control;

use silverorange\DevTest\Validation\UrlValidator;
use silverorange\DevTest\Control\RouteFactory;
use silverorange\DevTest\Exceptions\InvalidMethodException;

class UrlParser
{
    protected $baseURL;
    protected $urlValidator;

    public function __contstruct(RouteFactory $routeFactory, UrlValidator $urlValidator)
    {
        $this->routeFactory = $routeFactory;
        $this->URLValidator = $urlValidator;
    }

    /**
    * Parse out url path from arguments.
    *
    */
    public function parseRoute($url)
    {
        $url = $this->URLValidator->normalize($url);

        if ($this->URLValidator->validate($url) !== true) {
            throw new InvalidUrlException("Invalid url.");
        }

        $pieces = explode($url, "/");
        $route = $pieces[0];
        array_shift($pieces);

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $arguments = $pieces;
                break;
            case 'POST':
                $arguments = $_POST;
                break;
            default:
                throw new InvalidRequestMethodException("PUT and DELETE are disabled at this time.");
        }
        return $this->RouteFactory->createRoute($route, $arguments);
    }
}
