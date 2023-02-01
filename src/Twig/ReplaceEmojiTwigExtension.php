<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ReplaceEmojiTwigExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('replaceEmoji', [$this, 'makeReplaceEmoji'])
        ];
    }

    public function makeReplaceEmoji(string $text): string
    {
        if ($text === ":-)") {
            return "😀";
        }
        if ($text === ";-)") {
            return "😉";
        }
        if ($text === ":-|") {
            return "😑";
        }
        if ($text === "poop") {
            return "💩";
        }
        return "Pas d'emoji !";
    }
}