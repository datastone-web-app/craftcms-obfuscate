<?php declare(strict_types=1);

namespace datastone\obfuscate\twigextensions;

use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFilter;
use datastone\obfuscate\variables\DatastoneObfuscateVariable;


class DatastoneObfuscateTwigExtension extends \Twig\Extension\AbstractExtension
{
    public $obfuscator;

    public function __construct()
    {
        // TODO: DI?
        $this->obfuscator = new DatastoneObfuscateVariable();
    }

    public function getName(): string
    {
        return 'Obfuscate';
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('obfuscate', [$this, 'obfuscate']),
            new TwigFilter('obfuscateEmail', [$this, 'obfuscateEmail']),
            new TwigFilter('obfuscateMailTo', [$this, 'obfuscateMailTo']),
        ];
    }

    public function obfuscate(string $value): Markup
    {
        return $this->obfuscator->obfuscate($value);
    }

    public function obfuscateEmail(string $value): Markup
    {
        return $this->obfuscator->email($value);
    }

    public function obfuscateMailTo(string $value, ?string $title = null, array $attributes = []): Markup
    {
        return $this->obfuscator->mailto($value, $title, $attributes);
    }
}