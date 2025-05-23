<?php

namespace App\Console\Commands;

use App\Exceptions\NewCandybarFetchException;
use App\Mail\NewProductsAlertMail;
use App\Models\Candybar;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Command\Command as CommandAlias;

class NewCandybarsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'candybar:new-candybars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets new candybars from the external all knowing Candybar API';

    /**
     * Execute the console command.
     * @throws ConnectionException
     */

    public function handle(): int
    {
        try {
            $response = Http::get('https://run.mocky.io/v3/6d1eefaf-19ed-4a62-a4b5-f5507ba79ee7');

            if ($response->status() !== 200) {
                Log::error('Candybar API returned non-200 status', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);
                throw new NewCandybarFetchException("Candybar API returned non-200 status.");
            }

            $data = $response->json();

            if (!isset($data['data']) || !is_array($data['data'])) {
                Log::error('Candybar API response missing "data" key or not an array', ['body' => $data]);
                throw new NewCandybarFetchException("Candybar API response is invalid.");
            }

            $newCandybars = [];

            foreach ($data['data'] as $item) {
                if (!Candybar::where('name', $item['name'])->exists()) {
                    $newCandybars[] = $item;
                }
            }

            if (count($newCandybars)) {
                Mail::to(config('app.emails.candybarMaster', 'app.emails.admin'))
                    ->send(new NewProductsAlertMail($newCandybars));

                $this->info(count($newCandybars) . ' new candybars imported and mail sent.');
            } else {
                $this->info('No new candybars found.');
            }

            return self::SUCCESS;

        } catch (\Exception $e) {
            throw new NewCandybarFetchException($e->getMessage(), 0, $e);
        }
    }
}
