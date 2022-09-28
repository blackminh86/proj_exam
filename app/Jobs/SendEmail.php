<?php

namespace App\Jobs;
use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting ;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $params ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        $params = $this ->params;
        $setting = Setting::where('type_setting','setting_email_acc')->get();
        $setting = json_decode($setting[0]->description) ;
        $title   = Setting::where('type_setting','setting_email_title')->get();
        $title   = json_decode($title[0]->description) ;
        $result = Mail::send($params['view'] , compact('params'), function ($message) use ($params , $setting , $title) {  
            $message->from($setting->user, $setting->name);
            $message->to($params['email'], $params['name']);
            $subject = ($params['view'] == 'email.confirm_order') ?  $title->title_order : $title->title_contact ;
            $message->subject($subject);
        }); 
    }
}
