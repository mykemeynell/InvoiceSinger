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
                        <th class="right-align" width="250">Tax Rate</th>
                        <th class="right-align" width="150">Discount</th>
                        <th class="right-align" width="150">Total</th>
                        <th class="right-align" width="50">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="product in products">
                        <component is="product-row" :product="product" :currency="currency" :taxes="taxes"
                                   :units="units"></component>
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
                        <td class="right-align">{{ currency }}{{ subtotal }}</td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td class="right-align">{{ currency }}{{ tax }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td class="right-align">{{ currency }}{{ discount }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="right-align">{{ currency }}{{ total }}</td>
                    </tr>
                    <tr>
                        <th>Paid</th>
                        <td class="right-align">{{ currency }}0.00</td>
                    </tr>
                    <tr>
                        <th><span class="bold-text">Balance</span></th>
                        <td class="right-align">{{ currency }}0.00</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            currency: String,
            taxes: Array,
            units: Array,
            products: {
                type: Array,
                default: function () {
                    return [];
                }
            }
        },
        data() {
            return {
                count: 0,
                subtotal: parseFloat('0.00').toFixed(2),
                tax: parseFloat('0.00').toFixed(2),
                discount: parseFloat('0.00').toFixed(2),
                total: parseFloat('0.00').toFixed(2),
                paid: parseFloat('0.00').toFixed(2),
                balance: parseFloat('0.00').toFixed(2)
            };
        },
        methods: {
            addItem(product) {
                // If no product is defined, create an empty object.
                if (typeof product === 'undefined') {
                    product = {};
                }

                // Add the current count value into the product object, and
                // add it to the current list of this.products, and increment
                // the this.count value ready for the next item.
                product = $.extend({count: this.count}, product);
                this.products.push(product);
                this.count++;
                console.log(this.products);

                // Wait for 250ms before updating the totals for that product.
                // Something to do with a race condition. Nicer solution welcome.
                setTimeout(() => {
                    this.updateSummary();
                }, 250);
            },
            updateSummary() {
                // Can use this.$children as we dont use any other Vue components to construct the table.
                let items = this.$children;

                // Zero all values, ready for new totals.
                this.subtotal = 0;
                this.tax = 0;
                this.discount = 0;
                this.total = 0;

                // Loop over all products that have been added to the component.
                for (let current = 0; current < items.length; current++) {
                    // Subtotal
                    let subtotal = items[current].subtotal;
                    this.subtotal = (+this.subtotal + +subtotal).toFixed(2);

                    // Tax
                    let multiplier = items[current].tax.multiplier;
                    this.tax = (+this.tax + ((+subtotal * +multiplier) - +subtotal)).toFixed(2);

                    // Discount
                    let discount = items[current].discount;
                    this.discount = (+this.discount + +discount).toFixed(2);

                    // Total
                    let total = items[current].total;
                    this.total = (+this.total + +total).toFixed(2);
                }
            }
        },
        created() {
            // Add the count item to the list of products that have been passed into the component.
            for (let current = 0; current < this.products.length; current++) {
                this.products[current]['count'] = current;
                // Update the count value to continue from the end of the products list.
                this.count = +current + 1;
            }

            setTimeout(() => {
                this.updateSummary();
            }, 250);

            // Bind the 'add' button in the product modal to the addItem method.
            let that = this;
            $(document).on('click', '.js-add-product', function () {
                let product = window.table.row($(this).parents('tr')).data();
                that.addItem(product);
            });
        }
    }
</script>
