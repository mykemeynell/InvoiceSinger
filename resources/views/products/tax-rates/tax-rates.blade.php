@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row margin-y-30">
            <div class="col s12">
                <h4>Tax Rates</h4>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th class="right-align">Amount</th>
                        <th class="right-align">Options</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($tax_rates as $tax_rate)
                        <tr>
                            <td>{{ $tax_rate->getDisplayName() }}</td>
                            <td class="right-align">{{ $tax_rate->getAmount() }}&percnt;</td>
                            <td class="right-align"><a
                                        href="{{ route('products.taxRates.form', ['tax_rate_id' => $tax_rate->getKey()]) }}"
                                        class="waves-effect waves-light btn">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="center-align">No Tax Rates</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a href="{{ route('products.taxRates.form') }}" class="btn-floating btn-large halfway-fab waves-effect waves-light">
        <i class="material-icons">add</i>
    </a>
@endpush
