<template>
    <tr :id="rowId">
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
                <option v-for="unit in units" :value="unit.id">{{ unit.name }}</option>
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
                <option value="">No VAT</option>
                <option v-for="tax in taxes" :value="tax.id" :selected="product.tax_rate && product.tax_rate.id == tax.id ? true : false">{{ tax.name}}</option>
            </select>
        </td>
        <td class="right-align">
            {{ currency }}<span>{{ product.price ? product.price : '0.00' }}</span>
            <input type="hidden" :name="totalFieldName" value="0.00" :value="product.price">
        </td>
        <td class="right-align" width="50">
            <i class="material-icons pointer-cursor" @click="removeItem(product.count)">remove_circle_outline</i>
        </td>
    </tr>
</template>

<script>
    export default {
        mounted () {
            $('select').formSelect();
        },
        props: ['product', 'currency', 'taxes', 'units'],
        computed: {
            rowId: function () { return 'product-' + this.product.count; },
            nameFieldName: function () { return 'invoice[products][' + this.product.count + '][name]'; },
            descriptionFieldName: function () { return 'invoice[products][' + this.product.count + '][description]'; },
            priceFieldName: function () { return 'invoice[products][' + this.product.count + '][price]'; },
            quantityFieldName: function () { return 'invoice[products][' + this.product.count + '][quantity]'; },
            unitFieldName: function () { return 'invoice[products][' + this.product.count + '][unit]'; },
            subtotalFieldName: function () { return 'invoice[products][' + this.product.count + '][subtotal]'; },
            discountFieldName: function () { return 'invoice[products][' + this.product.count + '][discount]'; },
            taxRateFieldName: function () { return 'invoice[products][' + this.product.count + '][tax_rate]'; },
            totalFieldName: function () { return 'invoice[products][' + this.product.count + '][total]'; }
        },
        methods: {
            removeItem(index) {
                this.$parent.removeItem(index);
            }
        }
    }
</script>
