<template>
    <tr>
        <td>
            <input type="text" placeholder="Name" :name="nameFieldName" :value="product.name">
            <textarea class="materialize-textarea" placeholder="Description" :name="descriptionFieldName">{{ product.description }}</textarea>
        </td>
        <td class="right-align">
            <div class="input-field">
                <input type="text" class="right-align" :name="priceFieldName" :value="product.price ? product.price : '0.00'">
            </div>
        </td>
        <td class="right-align">
            <input type="text" class="right-align" :name="quantityFieldName" value="1">
            <select :name="unitFieldName">
                <option value="">Unit</option>
            </select>
        </td>
        <td class="right-align">
            {{ currency }}<span class="invoice-product-subtotal">{{ product.price ? product.price : '0.00' }}</span>
            <input type="hidden" :name="subtotalFieldName" id="subtotal-field" :value="product.price ? product.price : '0.00'">
        </td>
        <td class="right-align">
            <input type="text" class="right-align" :name="discountFieldName" value="0.00">
        </td>
        <td class="right-align">
            <select :name="taxRateFieldName">
                <option value="">Tax</option>
            </select>
        </td>
        <td class="right-align">
            {{ currency }}<span>{{ product.price ? product.price : '0.00' }}</span>
            <input type="hidden" :name="totalFieldName" value="0.00" :value="product.price">
        </td>
    </tr>
</template>

<script>
    export default {
        mounted () {
            console.log('Mounted Product Row vue template');
            $('select').formSelect();
        },
        props: ['count', 'product', 'currency'],
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
