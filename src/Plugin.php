<?php declare(strict_types=1);

namespace datastone\obfuscate;

use Craft;
use datastone\obfuscate\twigextensions\DatastoneObfuscateTwigExtension;
use datastone\obfuscate\services\DatastoneObfuscateService;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
    public function init(): void
    {
        parent::init();

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            fn (Event $e) => $e->sender->set('obfuscator', DatastoneObfuscateService::class)
        );

        if (Craft::$app->request->getIsSiteRequest()) {
            Craft::$app->view->registerTwigExtension(new DatastoneObfuscateTwigExtension($this->obfuscator));
        }
    }
    
    public static function config(): array
    {
        return [
            'components' => [
                'obfuscator' => ['class' => DatastoneObfuscateService::class]
            ],
        ];
    }
}
