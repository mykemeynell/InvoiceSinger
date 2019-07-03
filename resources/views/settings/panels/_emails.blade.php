<div class="card">
    <div class="card-content">
        <div class="row margin-bottom-30">
            <div class="col s12 input-field">
                <label>
                    <input type="checkbox" name="settings[email.attach]" class="filled-in"  @if(settings('app.online_payments.enabled') == true) checked="checked" @endif value="1">
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

    </div>
</div>
