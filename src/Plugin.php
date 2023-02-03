<?php declare(strict_types=1);

namespace datastone\obfuscate;

use Craft;
use datastone\obfuscate\twigextensions\DatastoneObfuscateTwigExtension;
use datastone\obfuscate\services\DatastoneObfuscateService;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
    public function init()
    {
        parent::init();

        $this->setComponents([
            'obfuscate' => \datastone\obfuscate\services\DatastoneObfuscateService::class
        ]);

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $e) {
                /** @var CraftVariable $variable */
                $variable = $e->sender;
                $variable->set('obfuscate', DatastoneObfuscateService::class);
            }
        );

        if (Craft::$app->request->getIsSiteRequest()) {
            Craft::$app->view->registerTwigExtension(new DatastoneObfuscateTwigExtension());
        }
    }
}