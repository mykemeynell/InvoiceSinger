<?php

namespace InvoiceSinger\View;

use Illuminate\Http\Request;
use Illuminate\View\View as ViewFactory;

/**
 * Class ViewComposer
 *
 * @package InvoiceSinger\View
 */
class ViewComposer
{
    /**
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * ViewComposer constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Compose the view.
     *
     * @param \Illuminate\View\View $view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compose(ViewFactory $view)
    {
        return $view->with('request', $this->request);
    }
}
