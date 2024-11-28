<?php

namespace RalfHortt\StoryblokForLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Illuminate\Support\Facades\Blade;
use RalfHortt\StoryblokForLaravel\Commands\StoryblokForLaravelCommand;

class StoryblokServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('storyblok-for-laravel')
            ->hasConfigFile('storyblok')
            // ->hasViewComponent('bloks', Alert::class)
            // ->hasViewComponent('blok', Alert::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('Horttcore/storyblok-for-laravel');
            });
            // ->hasViews()
            // ->hasMigration('create_storyblok_for_laravel_table')
            // ->hasCommand(StoryblokForLaravelCommand::class)
            ;
    }

    public function bootingPackage()
    {
        Blade::directive('storyblokEditable', function ($expression) {
            return "<?php
                if (isset({$expression}['_editable'])) {
                    \$editable = str({$expression}['_editable'])->replace(['<!--#storyblok#','-->'], ['']);
                    echo 'data-blok-uid=\"' . {$expression}['_uid'] . '\" data-blok-c=\"' . e(\$editable) . '\"';
                }
            ?>";
        });

        Blade::directive('storyblokScripts', function () {
            return <<<'EOT'
<script src="https://app.storyblok.com/f/storyblok-v2-latest.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof StoryblokBridge !== 'undefined') {
            const storyblokInstance = new StoryblokBridge({
                resolveRelations: <?php echo json_encode(config('storyblok.resolve_relations')) ?>,
            });
            storyblokInstance.on(['input'], (event) => {
                const element = document.querySelector(`[data-uid="${event.story.uuid}"]`);
                element.__livewire.$wire.set('story', event.story)
            });
        }
    });
</script>
EOT;
        });
    }
}
