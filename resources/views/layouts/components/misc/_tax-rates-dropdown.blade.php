@inject('tax_rate_service', \InvoiceSinger\Storage\Service\TaxRateService)

<select name="{{ $tax_rate_select_name }}" id="{{ $tax_rate_select_id }}" class="validate" @if(isset($tax_rate_required) && $tax_rate_required === true) required @endif>
    <option value="">No Tax</option>
    @foreach($tax_rate_service->fetch() as $tax_rate)
        <option value="{{ $tax_rate->getKey() }}" @if(! is_null($object) && $object->getTaxRate() === $tax_rate->getKey()) selected @endif>{{ $tax_rate->getDisplayName() }}</option>
    @endforeach
</select>
<label for="{{ $tax_rate_select_id }}">Tax Rate</label>
