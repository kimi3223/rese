<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateShops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:shops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ここにコマンドの実際の処理を記述します
        $this->info('CreateShopsコマンドが実行されました！');
    }
}
