<?php declare(strict_types=1);

namespace datastone\obfuscate\twigextensions;

use datastone\obfuscate\services\DatastoneObfuscateService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DatastoneObfuscateTwigExtension extends AbstractExtension
{
    public function __construct(public DatastoneObfuscateService $obfuscator) {}

    public function getName(): string
    {
        return 'Obfuscator';
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('obfuscate', [$this->obfuscator, 'obfuscate']),
            new TwigFilter('obfuscateEmail', [$this->obfuscator, 'email']),
            new TwigFilter('obfuscateMailTo', [$this->obfuscator, 'mailto']),
        ];
    }
}
