<template>
    <tr :id="rowId">
        <td>
            <input type="text" placeholder="Name" :name="nameFieldName" :value="product.name" required="required" class="validate">
            <textarea class="materialize-textarea" placeholder="Description" :name="descriptionFieldName">{{ product.description }}</textarea>
        </td>
        <td class="right-align">
            <div class="input-field">
                <input type="text" class="right-align validate" :name="priceFieldName" :value="price" v-on:change="updateTotals" required="required">
            </div>
        </td>
        <td class="right-align">
            <input type="text" class="right-align validate" :name="quantityFieldName" value="1" v-on:change="updateTotals" required="required">
            <select :name="unitFieldName" required="required" class="validate">
                <option v-for="unit in units" :value="unit.id">{{ unit.name }}</option>
            </select>
        </td>
        <td class="right-align">
            {{ currency }}<span class="invoice-product-subtotal">{{ subtotal }}</span>
            <input type="hidden" :name="subtotalFieldName" :value="subtotal">
        </td>
        <td class="right-align">
            <select :name="taxRateFieldName" v-on:change="updateTaxMultiplier">
                <option value="none">No Tax</option>
                <option v-for="tax in taxes" :value="tax.id" :selected="product.tax_rate && product.tax_rate.id == tax.id ? true : false">{{ tax.name}}</option>
            </select>
        </td>
        <td class="right-align">
            <input type="text" class="right-align" :name="discountFieldName" value="0.00" v-on:change="updateTotals">
        </td>
        <td class="right-align">
            {{ currency }}<span :id="totalSpanId">{{ total }}</span>
            <input type="hidden" :name="totalFieldName" :value="total">
        </td>
        <td class="right-align" width="50">
            <i class="material-icons pointer-cursor" @click="removeItem()">remove_circle_outline</i>
        </td>
    </tr>
</template>

<script>
    export default {
        mounted () {
            $('select').formSelect();
        },
        props: ['product', 'currency', 'taxes', 'units'],
        data: function () {
            let quantity = 1;
            let price = this.product.price ? this.product.price.toFixed(2) : parseFloat(0).toFixed(2);
            let subtotal = (price * quantity).toFixed(2);
            let discount = 0;
            let multiplier = this.product.tax_rate && this.product.tax_rate.multiplier ? this.product.tax_rate.multiplier : 1;
            let total = parseFloat((+subtotal * multiplier) - +discount).toFixed(2);

            return {
                price: price,
                subtotal: subtotal,
                discount: discount,
                quantity: quantity,
                tax: {
                    multiplier: multiplier
                },
                total: total
            }
        },
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
            totalFieldName: function () { return 'invoice[products][' + this.product.count + '][total]'; },
            totalSpanId: function () { return 'invoice-products-' + this.product.count + '-total'; }
        },
        methods: {
            created() {
                this.updateTotals();
            },
            removeItem() {
                this.$el.parentNode.removeChild(this.$el);
            },
            updateTaxMultiplier() {
                // Update total
                axios.get('/api/products/tax-rates', {
                    params: {id: $('[name="' + this.taxRateFieldName + '"]').val()}
                })
                    .then((response) => {
                        let tax_rate = response.data;
                        this.tax.multiplier = tax_rate.multiplier;
                    })
                    .then(() => {
                        this.updateTotals();
                    })
                    .catch(() => {
                        console.error('Failed to fetch tax rate from database.');
                    });
            },
            updateTotals() {
                // Update price
                this.price = parseFloat($('[name="' + this.priceFieldName + '"]').val()).toFixed(2);

                // Update subtotal
                this.quantity = parseFloat($('[name="' + this.quantityFieldName +'"]').val()).toFixed(2);
                this.subtotal = (this.price * this.quantity).toFixed(2);

                // Update discount
                this.discount = $('[name="' + this.discountFieldName + '"]').val();

                // Update total
                this.total = parseFloat((+this.subtotal * +this.tax.multiplier) - +this.discount).toFixed(2);

                this.$parent.updateSummary();
            }
        }
    }
</script>
