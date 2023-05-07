<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'tr_TR');
        Carbon::setLocale('tr');

        Paginator::useBootstrap();

        $this->app['form']->component('bsText', 'form_components.text', ['name', 'label_name', 'value' => null, 'attributes' => []]);
        $this->app['form']->component('bsSubmit', 'form_components.submit', ['name']);
        $this->app['form']->component('bsCheckbox', 'form_components.checkbox', ['name', 'label_name', 'elements' => []]);
        $this->app['form']->component('bsPassword', 'form_components.password', ['name', 'label_name', 'attributes' => []]);
        $this->app['form']->component('bsFile', 'form_components.file', ['name', 'label_name']);
        $this->app['form']->component('bsTextarea', 'form_components.textarea', ['name', 'label_name', 'value' => null, 'attributes' => []]);
        $this->app['form']->component('bsSelect', 'form_components.select', ['name', 'label_name', 'liste' => [], 'value', 'placeholder']);

        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}
