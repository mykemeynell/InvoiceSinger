<template>
    <tr>
        <td>
            <input type="text" value="" placeholder="Name" :name="nameFieldName">
            <textarea class="materialize-textarea" placeholder="Description" :name="descriptionFieldName"></textarea>
        </td>
        <td class="right-align">
            <div class="input-field">
                <input type="text" value="0.00" class="right-align" :name="priceFieldName">
            </div>
        </td>
        <td class="right-align">
            <input type="text" value="1" class="right-align" :name="quantityFieldName">
            <select :name="unitFieldName">
                <option value="">Unit</option>
            </select>
        </td>
        <td class="right-align">
            £<span class="invoice-product-subtotal">0.00</span>
            <input type="hidden" :name="subtotalFieldName" id="subtotal-field" value="0.00">
        </td>
        <td class="right-align">
            <input type="text" value="0" class="right-align" :name="discountFieldName">
        </td>
        <td class="right-align">
            <select :name="taxRateFieldName">
                <option value="">Tax</option>
            </select>
        </td>
        <td class="right-align">
            £<span>0.00</span>
            <input type="hidden" :name="totalFieldName" value="0.00">
        </td>
    </tr>
</template>

<script>
    export default {
        mounted () {
            console.log('Mounted Product Row vue template');
            $('select').formSelect();
        },
        props: ['count', 'product'],
        computed: {
            nameFieldName: function () { return 'invoice[products][' + this.count + '][name]'; },
            descriptionFieldName: function () { return 'invoice[products][' + this.count + '][description]'; },
            priceFieldName: function () { return 'invoice[products][' + this.count + '][price]'; },
            quantityFieldName: function () { return 'invoice[products][' + this.count + '][quantity]'; },
            unitFieldName: function () { return 'invoice[products][' + this.count + '][unit]'; },
            subtotalFieldName: function () { return 'invoice[products][' + this.count + '][subtotal]'; },
            discountFieldName: function () { return 'invoice[products][' + this.count + '][discount]'; },
            taxRateFieldName: function () { return 'invoice[products][' + this.count + '][tax_rate]'; },
            totalFieldName: function () { return 'invoice[products][' + this.count + '][total]'; }
        }
    }
</script>
