<?php

namespace App\Console\Commands;

use App\Word;
use Illuminate\Console\Command;

class ImportWordsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:words {quantity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import words from the web';

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
    public function handle()
    {
        $q = $this->argument('quantity');

        $words = 'https://github.com/dwyl/english-words/raw/master/words.txt';

        $handle = fopen($words, "r");

        $k = 1;

        $this->line('Importing words ... Quantity=' . $q);

        while (($buffer = fgets($handle, 255)) !== false && $k <= $q) {
            $k++;

            if (preg_match('#^[a-zA-Z]+$#', $buffer) !== false) {
                $word = new Word;
                $word->word = $buffer;
                $word->save();
            }

            if ($k % 100 == 0) {
                $this->line($k . ' words imported from ' . $q . ', ' . ($k * 100 / $q) . '%');
            }
        }
        fclose($handle);

        return 0;
    }
}
