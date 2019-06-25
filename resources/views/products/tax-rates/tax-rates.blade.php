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
                            <td class="right-align">{{ $taxRate->getAmount() }}</td>
                            <td class="right-align"><a class="waves-effect waves-light btn">View</a></td>
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
