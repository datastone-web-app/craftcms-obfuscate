<?php declare(strict_types=1);

namespace datastone\obfuscate\services;

use yii\base\Component;
use craft\helpers\Template;
use Twig\Markup;

class DatastoneObfuscateService extends Component
{
    /**
     * Obfuscate an e-mail address to prevent spam-bots from sniffing it.
     */
    public function email(string $email): Markup
    {
        // this makes sure the @ is always obfuscated.
        $email = str_replace('@', '&#64;', (string) $this->obfuscate($email));

        return Template::raw($email);
    }

    /**
     * Obfuscate a string to prevent spam-bots from sniffing it.
     */
    public function obfuscate(string $value): Markup
    {
        $safe = '';

        foreach (mb_str_split($value) as $letter)
        {
            if (ord($letter) > 128) {
                $safe .= $letter;
                continue;
            }

            // To properly obfuscate the value, we will randomly convert each letter to
            // its entity or hexadecimal representation, keeping a bot from sniffing
            // the randomly obfuscated letters out of the string on the responses.
            $safe .= match (mt_rand(1, 3)) {
                1 => '&#'.ord($letter).';',
                2 => '&#x'.dechex(ord($letter)).';',
                3 => $letter,
            };
        }
    
        return Template::raw($safe);
    }

    /**
     * Generate a HTML link to an email address.
     */
    public function mailto(string $email, ?string $title = null, array $attributes = []): Markup
    {
        $email = $this->email($email);

        $title = $title ?: $email;

        $email = $this->obfuscate('mailto:') . $email;

        $html = <<<HTML
            <a onclick="ga('send', 'event', 'Mailto', 'Click to Email', '{$title}');" href="{$email}"{$this->attributes($attributes)}>{$this->entities((string) $title)}</a>
        HTML;

        return Template::raw($html);
    }

    /**
     * Build an HTML attribute string from an array.
     */
    public function attributes(array $attributes): string
    {
        $html = [];

        // For numeric keys we will assume that the key and the value are the same
        // as this will convert HTML attributes such as "required" to a correct
        // form like required="required" instead of using incorrect numerics.
        foreach ((array) $attributes as $key => $value)
        {
            $element = $this->attributeElement($key, $value);

            if (!is_null($element)) $html[] = $element;
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     */
    protected function attributeElement(string $key, string $value): ?string 
    {
        if (is_numeric($key)) $key = $value;

        if (!is_null($value)) {
            return sprintf('%s="%s"', $key, $value);
        }

        return null;
    }

    /**
     * Convert an HTML string to entities.
     */
    public function entities(string $value): string
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }
}
