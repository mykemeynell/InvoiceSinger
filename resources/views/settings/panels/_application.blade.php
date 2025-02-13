<div class="card margin-bottom-30">
    <div class="card-content">
        <div class="card-title">
            <div class="row">
                <div class="col s12">
                    <span>General Settings</span>
                </div>
            </div>
        </div>

        <div class="row margin-bottom-0">
            <div class="col s12 input-field">
                <select name="settings[app.currency]" id="app-currency">
                    @foreach($app_currency_options as $alpha3 => $entity)
                        @php $currency = settings('app.currency'); @endphp
                        <option value="{{ $alpha3 }}" @if($currency === $alpha3) selected="selected" @endif>{{ $alpha3 }} ({!! $entity !!})</option>
                    @endforeach
                </select>
                <label for="app-currency">Currency</label>
            </div>
        </div>

    </div>
</div>
