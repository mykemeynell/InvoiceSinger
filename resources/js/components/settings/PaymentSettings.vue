<template>
    <div class="card">
        <div class="card-content">
            <div class="card-title">
                <div class="row">
                    <div class="col s12">
                        <span>Online Payments</span>
                    </div>
                </div>
            </div>

            <div class="row padding-bottom-30">
                <div class="col s12 input-field">
                    <label>
                        <input type="checkbox" name="settings[app.online_payments.enabled]" class="filled-in" value="1" v-bind:checked="settings['app.online_payments.enabled'] === 1">
                        <span>Enable</span>
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col s12 input-field">
                    <select type="text"
                            name="settings[app.online_payments.provider]"
                            id="app-payment-provider" @change="updateProvider">
                        <option v-for="prov in providers"
                                :value="prov.key" v-bind:selected="settings['app.online_payments.provider'] === prov.key">{{ prov.name }}
                        </option>
                    </select>
                    <label for="app-payment-provider">Payment Provider</label>
                </div>
            </div>

            <div v-for="prov in providers" v-if="prov.key === provider">
                <div class="row" v-for="field in prov.fields">
                    <div class="col s12 input-field">
                        <input type="text" :name="field.name" :id="field.name" v-bind:required="field.required === true" v-bind:value="settings[field.key].length > 0 ? '***' : ''">
                        <label :for="field.name">{{ field.label }}</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'settings': Object,
            'providers': Object
        },
        data() {
            return {
                'provider': this.settings['app.online_payments.provider']
            };
        },
        methods: {
            updateProvider() {
                this.provider = $('#app-payment-provider').val();
            }
        }
    }
</script>
