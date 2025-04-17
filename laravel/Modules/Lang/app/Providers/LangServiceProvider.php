<?php

declare(strict_types=1);

namespace Modules\Lang\Providers;

use Filament\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Infolists\Components\Entry;
use Filament\Support\Components\Component;
use Filament\Support\Concerns\Configurable;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\View;
use Modules\Lang\Actions\Filament\AutoLabelAction;
use Modules\Lang\Services\TranslatorService;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Xot\Services\BladeService;
use Webmozart\Assert\Assert;

/**
 * ---.
 */
class LangServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Lang';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
        parent::boot();
        $this->translatableComponents();
        $this->registerFilamentLabel();
    }

    public function register(): void
    {
        parent::register();
    }

    protected function translatableComponents(): void
    {
        $components = [Field::class, BaseFilter::class, Placeholder::class, Column::class, Entry::class];
        foreach ($components as $component) {
            /* @var Configurable $component */
            $component::configureUsing(function (Component $translatable): void {
                /* @phpstan-ignore method.notFound */
                $translatable->translateLabel();
            });
        }
    }

    public function registerFilamentLabel(): void
    {
        Field::configureUsing(function (Field $component) {
            $component = app(AutoLabelAction::class)->execute($component);
            Assert::isInstanceOf($component, Field::class);
            $validationMessages = __('user::validation');
            if (is_array($validationMessages)) {
                $typedMessages = [];
                foreach ($validationMessages as $key => $value) {
                    if (is_string($key) && (is_string($value) || $value instanceof \Closure)) {
                        $typedMessages[$key] = $value;
                    }
                }
                $component->validationMessages($typedMessages);
            }

            return $component;
        });

        BaseFilter::configureUsing(function (BaseFilter $component) {
            $component = app(AutoLabelAction::class)->execute($component);
            return $component;
        });

        Column::configureUsing(function (Column $component) {
            $component = app(AutoLabelAction::class)->execute($component);
            Assert::isInstanceOf($component, Column::class);
            $component = $component
                ->wrapHeader()
                ->verticallyAlignStart()
                ->grow();

            return $component;
        });

        Step::configureUsing(function (Step $component) {
            $component = app(AutoLabelAction::class)->execute($component);
            return $component;
        });

        Action::configureUsing(function (Action $component) {
            $component = app(AutoLabelAction::class)->execute($component);
            return $component;
        });

        TableAction::configureUsing(function (TableAction $component) {
            $component = app(AutoLabelAction::class)->execute($component);
            if (method_exists($component, 'iconButton')) {
                $component->iconButton();
            }
            if (method_exists($component, 'icon')) {
                $component->icon('heroicon-o-plus');
            }

            return $component;
        });
    }

    public function registerTranslator(): void
    {
        $this->app->singleton('translator', function (Container $app): TranslatorService {
            $loader = $app['translation.loader'];

            Assert::string($locale = $app['config']['app.locale']);
            Assert::string($fallback_locale = $app['config']['app.fallback_locale']);

            $translatorService = new TranslatorService($loader, $locale);
            $translatorService->setFallback($fallback_locale);

            return $translatorService;
        });
    }
}
