<?php

namespace InvoiceSinger\Http\Controllers\Settings;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Setting\SettingRequest;
use InvoiceSinger\Support\Concern\HasService;
use InvoiceSinger\Support\Encryption\Cryptor;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;
use LaravelDatabaseSettings\Service\Contract\SettingServiceInterface;
use mykemeynell\Support\CurrencyHtmlEntities;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class SettingController
 *
 * @method SettingServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\Settings
 */
class SettingController extends Controller
{
    use HasService;

    /**
     * The cryptor instance.
     *
     * @var \InvoiceSinger\Support\Encryption\Cryptor
     */
    protected $cryptor;

    /**
     * SettingController constructor.
     *
     * @param \LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service
     * @param \InvoiceSinger\Support\Encryption\Cryptor                         $cryptor
     */
    function __construct(SettingServiceInterface $service, Cryptor $cryptor)
    {
        $this->setService($service);
        $this->cryptor = $cryptor;
    }

    /**
     * Get the settings view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        /** @var \InvoiceSinger\PaymentProviders\PaymentProviderManager $manager */
        $manager = app('payment.providers.manager');

        $providers = $manager->providers()->map(static function($item, $key) {
            $name = $item->getName();
            $fields = collect($item->getFields())->map(static function ($item) {
                $encrypted = $item['encrypt'] ? '[encrypted]' : '';
                $item['key'] = $item['name'];
                $item['name'] = 'settings' . $encrypted . '[' . $item['name'] . ']';
                return $item;
            });
            return compact('name','key', 'fields');
        });

        /** @var \Illuminate\Database\Eloquent\Collection $settings */
        $settings = settings()->fetch()->reduce(function ($property, SettingEntityInterface $setting) {
            $property[$setting->getKey()] = $setting->getValue();
            return $property;
        });

        return view('settings')
            ->with('settings', collect($settings))
            ->with('payment_providers', $providers)
            ->with('app_currency_options', app()->make(CurrencyHtmlEntities::class)->all());
    }

    /**
     * Handle a post request for updating settings.
     *
     * @param \InvoiceSinger\Http\Requests\Setting\SettingRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function handlePost(SettingRequest $request): RedirectResponse
    {
        $payload = Arr::except($request->getParameterBag()->all(), ['encrypted']);

        if (array_key_exists('mail.password', $payload) && strlen($payload['mail.password']) > 0) {
            $settings = $request->getParameterBag()->all();
            $settings['mail.password'] = $this->cryptor->encrypt($request->getParameterBag()->get('mail.password'));
        }

        $payload['mail.attach'] = array_key_exists('mail.attach', $payload);
        $payload['app.online_payments.enabled'] = array_key_exists('app.online_payments.enabled', $payload);

        foreach ($payload as $key => $value) {
            $this->getService()->set($key, $value);
        }

        foreach ($request->getParameterBag()->get('encrypted') as $key => $value) {
            if($value === '***') { continue; }
            $value = $this->cryptor->encrypt($value);
            $this->getService()->set($key, $value);
        }

        settings()->fetch(true);

        return RedirectResponse::create(route('settings'));
    }
}
