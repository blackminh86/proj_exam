<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Config;
use DB;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('setting')) {
            $result = DB::table('setting')->select('description')
                ->where('type_setting', 'setting_email_acc')
                ->get()->toArray();
            if ($result != null) {
                $result = json_decode($result[0]->description, true);
                Config::set('mail.mailers.smtp.username', $result['user']);
                Config::set('mail.mailers.smtp.password', $result['password']);
                Config::set('mail.from.address', $result['user']);
                Config::set('mail.from.name', $result['name']);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
