<?php
namespace App\Kernel\View\TwigExtensions;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Facades\Auth\Auth;

class AuthExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('id', [$this, 'id']),
            new TwigFunction('showNick', [$this, 'showNick']),
        ];
    }

    public function id()
    {
        return Auth::id();
    }

    public function showNick()
    {
        return Auth::getUserNick();
    }
}