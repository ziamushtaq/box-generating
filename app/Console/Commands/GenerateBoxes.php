<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Box;
use Illuminate\Support\Facades\Mail;

class GenerateBoxes extends Command
{
    protected $signature = 'boxes:generate';
    protected $description = 'Generate boxes every minute';

    public function handle()
    {
        $colors = ['red', 'yellow', 'green', 'blue', 'pink', 'grey'];

        $count = Box::count();
        $scheduleTime = Box::latest()->first();
        if(!$scheduleTime){
            $newCount = 1;
            $addTime = 1;
        }else{
            $newCount = $scheduleTime->schedule_time * 2;
            $addTime = $newCount;
        }
        if ($count >= 16) {
            Mail::raw('1st Task Done with Zia Ur Rehman', function($message) {
                $message->to('Dawood.ahmed@collaborak.com')
                        ->subject('1st Task Done - Zia Ur Rehman');
            });
            return;
        }

        // $newCount = $scheduleTime * 2;

        for ($i = 0; $i < $newCount; $i++) {
            Box::create([
                'height' => 40,
                'width' => 100,
                'color' => $colors[array_rand($colors)],
                'schedule_time' => $addTime,
            ]);
        }

        $this->info("Boxes generated successfully");
    }
}

