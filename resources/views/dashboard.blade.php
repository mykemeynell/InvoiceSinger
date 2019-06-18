<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.components._head')
    <body>
        @stack('beginning')
        @include('layouts.components.header._header')

        <section>
            <div class="row">
                <div class="col s12 m6">
                    <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Quote Overview</span>

                            <table class="responsive-table">
                                <tr>
                                    <th>Draft</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Sent</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Viewed</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Approved</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Rejected</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Cancelled</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                            </table>

                        </div>
                        <div class="card-action">
                            <a href="#" class="waves-effect waves-light btn">New Quote</a>
                            <a href="#" class="waves-effect waves-light btn">Reload</a>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Invoice Overview</span>
                            <table class="responsive-table">
                                <tr>
                                    <th>Draft</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Sent</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Viewed</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th>Paid</th>
                                    <td class="right-align">&pound;0.00</td>
                                </tr>
                                <tr>
                                    <th class="red-text">Overdue</th>
                                    <td class="right-align red-text">&pound;0.00</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-action">
                            <a href="#" class="red waves-effect waves-light btn">Overdue Invoices</a>
                            <a href="#" class="waves-effect waves-light btn">New Invoice</a>
                            <a href="#" class="waves-effect waves-light btn">Reload</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Recent Quotes</span>
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Quote</th>
                                    <th>Client</th>
                                    <th class="right-align">Balance</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span class="badge grey lighten-3">Draft</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">QUO-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge green lighten-1 white-text">Approved</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">QUO-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge blue lighten-1 white-text">Sent</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">QUO-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge yellow darken-2 white-text">Viewed</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">QUO-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge grey darken-3 white-text">Cancelled</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">QUO-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge red darken-3 white-text">Rejected</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">QUO-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <a href="#" class="waves-effect waves-light btn">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Recent Invoices</span>
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Quote</th>
                                    <th>Client</th>
                                    <th class="right-align">Balance</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span class="badge grey lighten-3">Draft</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">INV-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge green lighten-1 white-text">Approved</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">INV-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge blue lighten-1 white-text">Sent</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">INV-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge yellow darken-2 white-text">Viewed</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">INV-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="badge red darken-3 white-text">Overdue</span></td>
                                    <td>04/06/2019</td>
                                    <td><a href="#">INV-18-0031</a></td>
                                    <td><a href="#">Silicon Labs</a></td>
                                    <td class="right-align">&pound;0.00</td>
                                    <td class="right-align"><a href="#"><i class="material-icons">insert_drive_file</i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <a href="#" class="waves-effect waves-light btn">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.components.misc._fab-button')
        @stack('before-scripts')
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('end')
    </body>
</html>
