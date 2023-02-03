<?php declare(strict_types=1);

namespace datastone\obfuscate\variables;

use datastone\obfuscate\Plugin;
use Twig\Markup;

class DatastoneObfuscateVariable
{
    /**
     * Obfuscate an e-mail address to prevent spam-bots from sniffing it.
     */
    public function email(string $email): Markup
    {
        return Plugin::getInstance()->obfuscate->email($email);
    }

    /**
     * Obfuscate a string to prevent spam-bots from sniffing it.
     */
    public function obfuscate(string $value): Markup
    {
        return Plugin::getInstance()->obfuscate->obfuscate($value);
    }

    /**
     * Generate a HTML link to an email address.
     */
    public function mailto(string $email, ?string $title = null, array $attributes = []): Markup
    {
        return Plugin::getInstance()->obfuscate->mailto($email, $title, $attributes);
    }

    /**
     * Build an HTML attribute string from an array.
     */
    public function attributes(array $attributes): string
    {
        return Plugin::getInstance()->obfuscate->attributes($attributes);
    }

    /**
     * Build a single attribute element.
     */
    protected function attributeElement(string $key, string $value): string
    {
        return Plugin::getInstance()->obfuscate->attributeElement($key, $value);
    }

    /**
     * Convert an HTML string to entities.
     */
    public function entities(string $value): string
    {
        return Plugin::getInstance()->obfuscate->entities($value);
    }
}