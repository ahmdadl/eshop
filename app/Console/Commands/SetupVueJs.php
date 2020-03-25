<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class SetupVueJs extends Command
{
    use VueFilesTxt;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:vuejs
                            {page_name?}
                            {--kjs : keep old javascipt files}
                            {--g : generate new page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'setup all vuejs needed files for multi page application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $fs)
    {
        $js = resource_path('js');

        // move to resources/js directory
        chdir($js);

        if ($this->option('g')) {
            if (!$this->argument('page_name')) {
                $this->error('you must enter a page name');
                return;
            }

            if (!$fs->exists('pages')) {
                $this->error('pages directory not found');
                return;
            }

            chdir('pages');

            $pageName = $this->argument('page_name');
            $kebpage = Str::kebab($this->argument('page_name'));

            // check if page is exists any way
            if ($fs->exists($kebpage . '.ts')) {
                $this->error("page $kebpage already exists");
                if (!$this->confirm('overwrite page?')) {
                    return;
                }
            }

            $fs->put(
                $kebpage . '.ts',
                $this->getNewPageTxt($pageName)
            );

            $this->info(
                $kebpage . '.ts was created successfully'
            );

            chdir('../');

            $txt = $fs->get('app.ts');
            $txt_lines = explode("\n", $txt);
            $output = [];
            $lastCompnent = '';

            for ($i = 0; $i < sizeof($txt_lines); $i++) {
                // get last import page statement
                $c = $txt_lines[$i];
                if (str::startsWith($c, 'import') && Str::contains($c, './pages') && strlen($txt_lines[$i + 1]) === 1) {
                    // extract last component name from import statement
                    $lastCompnent = explode(" ", $c)[1];
                    // assign this line first then add new line
                    $output[] = $c;
                    $output[] = "import $pageName from './pages/" . $kebpage . "';";
                    continue;
                }

                if (trim($c) === $lastCompnent . ',') {
                    $output[] = $c;
                    $output[] = "\t    " . $pageName . ",";
                    continue;
                }


                $output[] = $c;
            }

            // write to app.ts
            $fs->put('app.ts', implode("\n", $output));

            return;
        }

        // create required directories
        if ($fs->exists($js . '/pages')) {
            $this->info('All files was created succefully');
            return;
        }

        // create index ts file
        touch('app.ts');
        $fs->put('app.ts', self::$App);

        mkdir('pages');
        chdir('pages');

        $fs->put('index-template.html', self::$indexHtml);
        $fs->put('super.ts', self::$super);
        $fs->put('home.ts', self::$home);

        chdir('../');

        // remove useless files if no argument
        if (!$this->option('kjs')) {
            $this->info('removing old javascript files');
            $fs->delete('app.js');
            $fs->delete('bootstrap.js');

            // remove all components
            array_map('unlink', glob('components/*.*'));
        }

        // go to root directory
        chdir('../../');
        // create tsconfig file
        $fs->put('tsconfig.json', self::$tsconfig);
        // update webpack mix configration
        $fs->put('webpack.mix.js', self::$mix);

        $this->info('updated tsconfig and webpack, please update your website name in webpack.mix file');

        // updating package.json
        $package = json_decode($fs->get('package.json'));

        $dev = $package->devDependencies;

        if (!isset($package->dependencies)) $package->dependencies = (object) [];

        $req = $package->dependencies;

        // add to dev
        $dev->{'ts-loader'} = '^6.2.2';
        $dev->{'browser-sync'} = '^2.26.7';
        $dev->{'browser-sync-webpack-plugin'} = '^2.0.1';

        // add to requirments
        $req->{'bootstrap.native'} = '^2.0.27';
        $req->{'typescript'} = '^3.8.3';
        $req->{'vue-class-component'} = '^7.2.3';
        $req->{'vue-property-decorator'} = '^8.4.1';

        // print formatted json
        $fs->put('package.json', (collect($package))->toJson(JSON_PRETTY_PRINT));

        $this->info('package.json updated successfully');

        $this->info('please add this code in your layout file');
        $this->info(self::$layout);
    }
}
