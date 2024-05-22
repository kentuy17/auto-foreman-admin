<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RunningApps;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function __invoke()
    {
        return response()
            ->stream(function () {
                while (true) {
                    if (connection_aborted()) {
                        break;
                    }

                    if ($messages = RunningApps::where('created_at', '>=', Carbon::now()->subSeconds(5))->get()) {
                        echo "event: ping\n", "data: {$messages}", "\n\n";
                    }

                    ob_flush();
                    flush();
                    sleep(5);
                }
            }, 200, [
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'text/event-stream',
            ]);
    }
}
