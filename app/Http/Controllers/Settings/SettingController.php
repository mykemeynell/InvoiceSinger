<?php

namespace InvoiceSinger\Http\Controllers\Settings;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Setting\SettingRequest;
use InvoiceSinger\Support\Concern\HasService;
use InvoiceSinger\Support\Encryption\Cryptor;
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
        dd(app('payment.providers.manager'));

        /** @var \InvoiceSinger\PaymentProviders\PaymentProviderManager $manager */
        $manager = app('payment.providers.manager');

        return view('settings')
            ->with('payment_providers', $manager->getProviders())
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
        $payload = $request->getParameterBag()->all();

        if (array_key_exists('mail.password', $payload) && strlen($payload['mail.password']) > 0) {
            $settings = $request->getParameterBag()->all();
            $settings['mail.password'] = $this->cryptor->encrypt($request->getParameterBag()->get('mail.password'));
        }

        $payload['mail.attach'] = array_key_exists('mail.attach', $payload);

        foreach ($payload as $key => $value) {
            $this->getService()->set($key, $value);
        }

        return RedirectResponse::create(route('settings'));
    }
}
