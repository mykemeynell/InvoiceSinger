<template>
    <tr>
        <td>
            <input type="text" value="" placeholder="Name" name="">
            <textarea class="materialize-textarea" placeholder="Description" name=""></textarea>
        </td>
        <td class="right-align">
            <div class="input-field">
                <input type="text" value="0.00" class="right-align" name="">
            </div>
        </td>
        <td class="right-align">
            <input type="text" value="1" class="right-align" name="">
            <select>
                <option value="">Unit</option>
            </select>
        </td>
        <td class="right-align">
            £<span class="invoice-product-subtotal">0.00</span>
        </td>
        <td class="right-align">
            <input type="text" value="0" class="right-align" name="">
        </td>
        <td class="right-align">
            <select>
                <option value="">Tax</option>
            </select>
        </td>
        <td class="right-align">
            £0.00
        </td>
    </tr>
</template>

<script>
    export default {
        mounted () {
            console.log('Mounted Product Row vue template');
        }
    }
</script>
