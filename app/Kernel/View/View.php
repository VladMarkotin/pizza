<?php
namespace App\Kernel\View;

use \Twig\Loader\ArrayLoader;
use \Twig\TwigTest;

class View
{
    private static $twig;

    public static function render(string $template, array $params = [])
    {
        echo self::$twig->render($template.$_ENV['TEMPLATE_EXTENSION'], $params);
    }

    public static function getInstance()
    {
        $loader = new \Twig\Loader\FilesystemLoader($_ENV['TEMPLATE_PATH']);
        self::$twig = new \Twig\Environment($loader);

        self::$twig->addExtension(new \App\Kernel\View\TwigExtensions\AuthExtension());

        self::$twig->addTest(new TwigTest('array', function ($value) {
            return is_array($value);
        }));
    } 
}