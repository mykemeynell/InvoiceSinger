<div class="card">
    <div class="card-content">
        <div class="row margin-bottom-30">
            <div class="col s12 input-field">
                <label>
                    <input type="checkbox" name="settings[email.attach]" class="filled-in"  @if(settings('app.online_payments.enabled') == true) checked="checked" @endif>
                    <span>Attach Quote/Invoice to email</span>
                </label>
            </div>
        </div>

        <div class="row padding-top-30">
            <div class="col s12 input-field">
                <select name="settings[email.provider]" id="email-provider">
                    <option value="none" @if(settings('email.provider') == 'none') selected="selected" @endif>None</option>
                    <option value="phpmail" @if(settings('email.provider') == 'phpmail') selected="selected" @endif>PHP Mail</option>
                    <option value="sendmail" @if(settings('email.provider') == 'sendmail') selected="selected" @endif>Sendmail</option>
                    <option value="smtp" @if(settings('email.provider') == 'smtp') selected="selected" @endif>SMTP</option>
                </select>
                <label for="email-provider">Email Provider</label>
            </div>
        </div>

        <div id="email-options">
            <div class="row padding-top-15">
                <div class="col s6 input-field">
                    <input type="text" name="settings[email.from_address]" value="{{ settings('email.from_address') }}" id="email-from_address">
                    <label for="email-from_address">From Address</label>
                </div>
                <div class="col s6 input-field">
                    <input type="text" name="settings[email.from_name]" value="{{ settings('email.from_name') }}" id="email-from_name">
                    <label for="email-from_name">From Name</label>
                </div>
            </div>
            <div class="row padding-top-15">
                <div class="col s6 input-field">
                    <input type="text" name="settings[email.username]" value="{{ settings('email.username') }}" id="email-username">
                    <label for="email-username">Username</label>
                </div>
                <div class="col s6 input-field">
                    <input type="password" name="settings[email.password]" id="email-password">
                    <label for="email-password">Password</label>
                </div>
            </div>
            <div class="row padding-top-15">
                <div class="col s6 input-field">
                    <select type="text" name="settings[email.encryption]" value="{{ settings('email.encryption') }}" id="email-encryption">
                        <option value="none" @if(settings('email.encryption') == 'none') selected @endif>None</option>
                        <option value="tls" @if(settings('email.encryption') == 'tls') selected @endif>TLS</option>
                        <option value="ssl" @if(settings('email.encryption') == 'ssl') selected @endif>SSL</option>
                    </select>
                    <label for="email-encryption">Encryption</label>
                </div>
            </div>
        </div>

    </div>
</div>
