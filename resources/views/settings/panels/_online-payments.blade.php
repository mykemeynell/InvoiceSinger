<div class="card">
    <div class="card-content">
        <div class="card-title">
            <div class="row">
                <div class="col s12">
                    <span>Online Payments</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 input-field">
                <label>
                    <input type="checkbox" class="filled-in" @if(settings('app.online_payments.enabled') == true) checked="checked" @endif>
                    <span>Enable</span>
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 input-field">
                <label>
                    <select type="text" name="settings[app.online_payments.provider]"id="email-encryption">
                        @foreach($providers as $key => $provider)
                        <option value="{{ $key }}" @if(settings('app.online_payments.provider') === $key) selected @endif>{{ $provider->getName() }}</option>
                        @endforeach
                    </select>
                    <label for="email-encryption">Encryption</label>
                </label>
            </div>
        </div>

    </div>
</div>
