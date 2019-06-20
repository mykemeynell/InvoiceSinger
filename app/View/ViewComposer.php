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
     * ViewComposer constructor.
     */
    function __construct()
    {}

    /**
     * Compose the view.
     *
     * @param \Illuminate\View\View $view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compose(ViewFactory $view)
    {
        return $view;
    }
}
