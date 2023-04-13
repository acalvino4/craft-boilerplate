<?php

namespace modules\cpassets;

use Craft;
use craft\events\TemplateEvent;
use craft\web\View;
use nystudio107\vite\Vite;
use yii\base\Event;
use yii\base\Module as BaseModule;

/**
 * cp-assets module
 *
 * @method static Module getInstance()
 */
class Module extends BaseModule
{
    public function init(): void
    {
        Craft::setAlias('@modules/cpassets', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->request->isConsoleRequest) {
            $this->controllerNamespace = 'modules\\cpassets\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\cpassets\\controllers';
        }

        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
        });
    }

    private function attachEventHandlers(): void
    {
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return;
        };

        Event::on(
            View::class,
            View::EVENT_BEFORE_RENDER_TEMPLATE,
            function(TemplateEvent $event) {
                Vite::getInstance()?->vite->register('src/scripts/cp.ts');
            }
        );
    }
}
