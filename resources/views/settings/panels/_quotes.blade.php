<div class="card">
    <div class="card-content">
        <div class="row">
            <div class="col s12 input-field">
                <input type="text" id="invoice-pattern" name="settings[quote.pattern]" value="{{ settings('quote.pattern') }}">
                <label for="invoice-pattern">Quote Pattern</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 input-field">
                <select name="settings[quote.term]" id="invoice-term">
                    <option value="10 days" @if(settings('quote.term') == '10 days') selected="selected" @endif>NET 10</option>
                    <option value="15 days" @if(settings('quote.term') == '15 days') selected="selected" @endif>NET 15</option>
                    <option value="30 days" @if(settings('quote.term') == '30 days') selected="selected" @endif>NET 30</option>
                    <option value="60 days" @if(settings('quote.term') == '60 days') selected="selected" @endif>NET 60</option>
                </select>
                <label for="invoice-pattern">Quote Term (Net D)</label>
            </div>
        </div>

        <div class="row margin-bottom-0">
            <div class="col s12 input-field">
                <textarea name="settings[quote.footer]" id="invoice-footer" class="materialize-textarea"></textarea>
                <label for="invoice-pattern">Quote Footer</label>
            </div>
        </div>

    </div>
</div>
