<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Admin\Product\Models\Images;

class FixImageSortOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:fix-sort-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Normalize image sort order and main flag for each product';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Images::query()
            ->orderBy('product_id')
            ->orderBy('id')
            ->get()
            ->groupBy('product_id')
            ->each(function ($images) {
                foreach ($images->values() as $index => $image) {
                    $image->sort_order = $index;
                    $image->is_main = $index === 0;
                    $image->save();
                }
            });

        $this->info('Image sort order fixed.');

        return self::SUCCESS;
    }
}
