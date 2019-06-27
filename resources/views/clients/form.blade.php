@extends('layouts.app')

@section('content')

    {{-- Form action buttons --}}

    {{-- End form action buttons --}}

    <form id="client-form" name="client-form">
        {!! csrf_field() !!}
        <div class="container">
            <div class="row margin-y-30">
                <div class="col s12 m6">
                    <h4 class="margin-0">{{ $client ? 'Edit' : 'Create' }} Client</h4>
                </div>
                <div class="col s12 m6 right-align">
                    <button form="client-form" formmethod="POST" formaction="{{ route('clients.handleForm') }}"
                            class="waves-light waves-effect btn-flat margin-right-15">Save
                    </button>
                    <a href="{{ route('clients') }}" class="waves-light waves-effect btn-flat">Cancel</a>
                    @if(! is_null($client))
                        <form name="delete-client-form" id="delete-client-form">
                            {!! csrf_field() !!}
                            <button form="delete-client-form" formaction="{{ route('clients.handleDelete', ['client_id' => $client->getKey()]) }}" formmethod="POST" class="waves-light waves-effect btn red darken-1 margin-left-15">Delete</button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Personal Information Card--}}
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                <span>Personal Information</span>
                            </div>
                            <div class="row">
                                <div class="col s12 m2 input-field">
                                    <select name="client[title]" id="client-title">
                                        <option value="" disabled selected>Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Sir">Sir</option>
                                        <option value="Lady">Lady</option>
                                        <option value="Ind">Ind</option>
                                    </select>
                                </div>
                                <div class="col s12 m5 input-field">
                                    <input type="text" class="validate" name="client[first_name]" id="first-name"
                                           value="@if(! is_null($client)){{ $client->getFirstName() }}@endif" required
                                           autofocus>
                                    <label for="first-name">First name</label>
                                </div>
                                <div class="col s12 m5 input-field">
                                    <input type="text" class="validate" name="client[last_name]" id="last-name"
                                           value="@if(! is_null($client)){{ $client->getLastName() }}@endif">
                                    <label for="last-name">Last name (Optional)</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[business_name]" id="business-name"
                                           value="@if(! is_null($client)){{ $client->getBusinessName() }}@endif">
                                    <label for="business-name">Business name (Optional)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End personal information --}}

            <div class="row">
                {{-- Address --}}
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title"><span>Address</span></div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[address_1]" id="street-address"
                                           value="@if(! is_null($client)){{ $client->getAddress1() }}@endif">
                                    <label for="street-address">Street Address (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[address_2]" id="street-address-2"
                                           value="@if(! is_null($client)){{ $client->getAddress2() }}@endif">
                                    <label for="street-address-2">Street Address (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[town_city]" id="city"
                                           value="@if(! is_null($client)){{ $client->getTownCity() }}@endif">
                                    <label for="city">City (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[postcode]" id="postcode"
                                           value="@if(! is_null($client)){{ $client->getPostcode() }}@endif">
                                    <label for="postcode">Postcode (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <select id="country" name="client[country]">
                                        <option value="" disabled selected>Select your country</option>
                                        @foreach($countries as $country)
                                            <option @if(! is_null($client) && $client->getCountry() === $country['alpha3']) selected="selected"
                                                    @endif value="{{ $country['alpha3'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <label for="country">Country (Optional)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Address --}}

                {{-- Contact Information --}}
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title"><span>Contact Information</span></div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[telephone]" id="telephone"
                                           value="@if(! is_null($client)){{ $client->getTelephone() }}@endif">
                                    <label for="telephone">Telephone (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[fax]" id="fax"
                                           value="@if(! is_null($client)){{ $client->getFax() }}@endif">
                                    <label for="fax">Fax (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[mobile]" id="mobile"
                                           value="@if(! is_null($client)){{ $client->getMobile() }}@endif">
                                    <label for="mobile">Mobile (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[email_address]" id="email-address"
                                           value="@if(! is_null($client)){{ $client->getEmailAddress() }}@endif">
                                    <label for="email-address">Email Address (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[web]" id="client-web"
                                           value="@if(! is_null($client)){{ $client->getWebAddress() }}@endif">
                                    <label for="client-web">Website (Optional)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End contact information --}}
            </div>

            <div class="row">
                {{-- Additional Information --}}
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title"><span>Additional Information</span></div>

                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[vat_number]" id="vat"
                                           value="@if(! is_null($client)){{ $client->getVatNumber() }}@endif">
                                    <label for="vat">VAT Number (Optional)</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <label>
                                        <input type="checkbox" name="client[is_active]" class="filled-in"
                                               @if(! is_null($client)){{ $client->isActive() ? 'checked="checked"' : '' }}@else checked="checked" @endif
                                        "">
                                        <span>Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End additional information --}}
            </div>

        </div>
    </form>

@endsection
