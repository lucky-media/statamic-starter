<?php

use Illuminate\Support\Facades\File;

class StarterKitPostInstall
{
    public function handle($console)
    {
        $webpack = base_path('webpack.mix.js');

        if (File::exists($webpack)) {
            File::delete($webpack);

            $console->line('Webpack file removed.');
        }

        $console->line('Thanks for installing!');
    }
}
