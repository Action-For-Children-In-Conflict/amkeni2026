<?php

namespace App\Support;

class RichContent
{
    /**
     * Render HTML from the rich-text editor, turning bare URLs into links.
     *
     * Editors often store a pasted URL as plain text. Splitting the markup into
     * tags and text lets us link only the visible text, leaving attributes such
     * as src/href and existing <a> elements untouched.
     */
    public static function render(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        $parts = preg_split('/(<[^>]+>)/', $html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if ($parts === false) {
            return $html;
        }

        $linkDepth = 0;

        foreach ($parts as $index => $part) {
            if (str_starts_with($part, '<')) {
                if (preg_match('/^<a\b/i', $part) === 1) {
                    $linkDepth++;
                } elseif (preg_match('/^<\/a\b/i', $part) === 1) {
                    $linkDepth = max(0, $linkDepth - 1);
                }

                continue;
            }

            if ($linkDepth > 0 || trim($part) === '') {
                continue;
            }

            $parts[$index] = self::linkifyText($part);
        }

        return implode('', $parts);
    }

    private static function linkifyText(string $text): string
    {
        $pattern = '~(?:https?://|www\.)[^\s<>"\']+~iu';

        return preg_replace_callback($pattern, static function (array $matches): string {
            $url = html_entity_decode($matches[0], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $trailing = '';

            while ($url !== '' && preg_match('/[.,;:!?\)\]]$/u', $url) === 1) {
                $trailing = substr($url, -1).$trailing;
                $url = substr($url, 0, -1);
            }

            if ($url === '') {
                return $matches[0];
            }

            $href = str_starts_with($url, 'www.') ? 'https://'.$url : $url;

            return '<a href="'.e($href).'" target="_blank" rel="noopener noreferrer">'.e($url).'</a>'.$trailing;
        }, $text) ?? $text;
    }
}
