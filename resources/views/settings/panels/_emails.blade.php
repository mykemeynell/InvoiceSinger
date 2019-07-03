<div class="card">
    <div class="card-content">
        <div class="row margin-bottom-30">
            <div class="col s12 input-field">
                <label>
                    <input type="checkbox" name="settings[mail.attach]" class="filled-in"  @if(settings('app.online_payments.enabled') == true) checked="checked" @endif>
                    <span>Attach Quote/Invoice to email</span>
                </label>
            </div>
        </div>

        <div class="row padding-top-30">
            <div class="col s12 input-field">
                <select name="settings[mail.provider]" id="email-provider">
                    <option value="none" @if(settings('mail.provider') == 'none') selected="selected" @endif>None</option>
                    <option value="phpmail" @if(settings('mail.provider') == 'phpmail') selected="selected" @endif>PHP Mail</option>
                    <option value="sendmail" @if(settings('mail.provider') == 'sendmail') selected="selected" @endif>Sendmail</option>
                    <option value="smtp" @if(settings('mail.provider') == 'smtp') selected="selected" @endif>SMTP</option>
                </select>
                <label for="email-provider">Email Provider</label>
            </div>
        </div>

        <div id="email-options">
            <div class="row padding-top-15">
                <div class="col s6 input-field">
                    <input type="text" name="settings[mail.from_address]" value="{{ settings('mail.from_address') }}" id="email-from_address">
                    <label for="email-from_address">From Address</label>
                </div>
                <div class="col s6 input-field">
                    <input type="text" name="settings[mail.from_name]" value="{{ settings('mail.from_name') }}" id="email-from_name">
                    <label for="email-from_name">From Name</label>
                </div>
            </div>
            <div class="row padding-top-15">
                <div class="col s6 input-field">
                    <input type="text" name="settings[mail.username]" value="{{ settings('mail.username') }}" id="email-username">
                    <label for="email-username">Username</label>
                </div>
                <div class="col s6 input-field">
                    <input type="password" name="settings[mail.password]" id="email-password">
                    <label for="email-password">Password</label>
                </div>
            </div>
            <div class="row padding-top-15">
                <div class="col s6 input-field">
                    <select type="text" name="settings[mail.encryption]" value="{{ settings('mail.encryption') }}" id="email-encryption">
                        <option value="none" @if(settings('mail.encryption') == 'none') selected @endif>None</option>
                        <option value="tls" @if(settings('mail.encryption') == 'tls') selected @endif>TLS</option>
                        <option value="ssl" @if(settings('mail.encryption') == 'ssl') selected @endif>SSL</option>
                    </select>
                    <label for="email-encryption">Encryption</label>
                </div>
            </div>
        </div>

    </div>
</div>
