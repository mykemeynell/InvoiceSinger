@extends('layouts.app')

@section('content')

    {{-- Form action buttons --}}

    {{-- End form action buttons --}}

    <form id="client-form" name="client-form">
        {!! csrf_field() !!}
        <div class="container">
            <div class="row margin-y-30">
                <div class="col s12 m6">
                    <h4 class="margin-0">Create/Edit Client</h4>
                </div>
                <div class="col s12 right-align">
                    <button form="client-form" formmethod="POST" formaction="{{ route('clients.handleForm') }}" class="waves-light waves-effect btn margin-right-15">Save</button>
                    <a href="{{ route('clients') }}" class="waves-light waves-effect btn red darken-1">Discard</a>
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
                                <div class="col s12 m6 input-field">
                                    <input type="text" class="validate" name="client[first_name]" id="first-name" required autofocus>
                                    <label for="first-name">First name</label>
                                </div>
                                <div class="col s12 m6 input-field">
                                    <input type="text" class="validate" name="client[last_name]" id="last-name">
                                    <label for="last-name">Last name (Optional)</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[business_name]" id="business-name">
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
                                    <input type="text" class="validate" name="client[address_1]" id="street-address">
                                    <label for="street-address">Street Address (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[address_2]" id="street-address-2">
                                    <label for="street-address-2">Street Address (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[town_city]" id="city">
                                    <label for="city">City (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[postcode]" id="postcode">
                                    <label for="postcode">Postcode (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <select id="country" name="client[country]">
                                        <option value="" disabled selected>Select your country</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
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
                                    <input type="text" class="validate" name="client[telephone]" id="telephone">
                                    <label for="telephone">Telephone (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[fax]" id="fax">
                                    <label for="fax">Fax (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[mobile]" id="mobile">
                                    <label for="mobile">Mobile (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[email_address]" id="email-address">
                                    <label for="email-address">Email Address (Optional)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" class="validate" name="client[web]" id="client-web">
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
                                    <input type="text" class="validate" name="client[vat_number]" id="vat">
                                    <label for="vat">VAT Number (Optional)</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <label>
                                        <input type="checkbox" name="client[is_active]" class="filled-in" checked="checked">
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
