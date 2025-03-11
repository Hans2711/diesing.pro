<?php

namespace App\Console\Commands;

use App\Models\Testobject;
use App\Models\Diffstore;
use App\Models\FileReference;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Storage;
use Spatie\Sitemap\SitemapGenerator;

use function Livewire\store;

class CleanFileReferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "clean:file-references";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Clean file references";

    protected $allowedPaths = ["public/portfolio_media"];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $references = FileReference::all();
        $files = Storage::allFiles();

        foreach ($files as $file) {
            if (str_starts_with($file, ".")) {
                continue;
            }

            if (
                !in_array(
                    pathinfo($file, PATHINFO_DIRNAME),
                    $this->allowedPaths
                )
            ) {
                continue;
            }

            $reference = $references->firstWhere("path", $file);
            if ($reference) {
                continue;
            } else {
                Storage::delete($file);
            }
        }
    }
}
