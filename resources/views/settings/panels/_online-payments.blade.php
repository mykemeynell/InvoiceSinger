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

    </div>
</div>
