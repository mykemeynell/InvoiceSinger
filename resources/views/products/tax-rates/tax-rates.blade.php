@extends('layouts.app')

@section('content')
    <div class="container">
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
                    @forelse($taxRates as $taxRate)
                        <tr>
                            <td>{{ $taxRate->getDisplayName() }}</td>
                            <td class="right-align">{{ $taxRate->getAmount() }}&percnt;</td>
                            <td class="right-align"><a
                                        href="{{ route('products.taxRates.form', ['tax_rate_id' => $taxRate->getKey()]) }}"
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
