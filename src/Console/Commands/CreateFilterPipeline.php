<?php

namespace MikhailMouner\GenerateFilter\Console\Commands;

use Illuminate\Console\Command;
use MikhailMouner\GenerateFilter\Console\Commands\Generator\Filter;

class CreateFilterPipeline extends Command
{
    protected $signature = 'filter:class {model} {filter}';

    protected $description = 'Create Filter Pipeline';

    private Filter $pipeline;

    /**
     * Create a new command instance.
     *
     */
    public function __construct(Filter $pipeline)
    {
        parent::__construct();
        $this->pipeline = $pipeline;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $model = $this->argument('model');
        $filter = $this->argument('filter');
        list($type, $message) = $this->pipeline->execute($model, $filter);
        $this->$type($message);
    }

}
