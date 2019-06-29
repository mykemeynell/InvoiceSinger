<template>
    <div id="product-table-wrapper">
        <!-- Product table -->
        <div class="row">
            <div class="col s12">
                <table class="responsive-table" id="invoice-table">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th class="right-align" width="150">Price</th>
                        <th class="right-align" width="250">Quantity</th>
                        <th class="right-align" width="150">Subtotal</th>
                        <th class="right-align" width="150">Discount</th>
                        <th class="right-align" width="250">Tax Rate</th>
                        <th class="right-align" width="150">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        <template v-for="(product, index) in products">
                            <component is="product-row"></component>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary table and add buttons -->
        <div class="row">
            <div class="col s9">
                <a class="waves-effect waves-dark btn-flat margin-right-15" @click="addItem()">Add Item</a>
                <a href="#add-product-modal" class="waves-effect waves-dark btn-flat modal-trigger">Add Product</a>
            </div>

            <div class="col s3">
            <table class="responsive-table">
                <tr>
                    <th>Subtotal</th>
                    <td class="right-align">
                        &pound;<span id="invoice-totals-subtotal">0.00</span>
                    </td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td class="right-align">20%</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td class="right-align">
                        &pound;<span id="invoice-totals-discount">0.00</span>
                    </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td class="right-align">
                        &pound;<span id="invoice-totals-total">0.00</span>
                    </td>
                </tr>
                <tr>
                    <th>Paid</th>
                    <td class="right-align">
                        &pound;<span id="invoice-totals-paid">0.00</span>
                    </td>
                </tr>
                <tr>
                    <th><span class="bold-text">Balance</span></th>
                    <td class="right-align">
                        &pound;<span id="invoice-totals-balance">0.00</span>
                    </td>
                </tr>
            </table>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted () {
            console.log('Mounted Product Table vue template');
        },
        data() {
            return {
                products: []
            };
        },
        methods: {
            addItem(product) {
                if(typeof product === 'undefined') {
                    product = [];
                }
                this.products.push(product);
            }
        }
    }
</script>
