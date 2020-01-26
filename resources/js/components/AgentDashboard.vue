<template>
    <form>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="input-group lead-search">
                    <label for="dot_number">DOT Number</label>
                    <input type="text" class="form-control" id="dot_number" v-model="dot_number">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" @click="fetchLead(dot_number)" style="background:burlywood">Search</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row" style="background:burlywood">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="legal_name">Contact Name</label>
                    <input type="text" class="form-control" id="legal_name" v-model="lead.legal_name">
                </div>
                <div class="form-group">
                    <label for="email_address">Email</label>
                    <input type="email" class="form-control" id="email_address" v-model="lead.email_address">
                </div>
                <div class="form-group">
                    <label for="phy_street">Street</label>
                    <input type="text" class="form-control" id="phy_street" v-model="lead.phy_street">
                </div>
                <div class="form-group">
                    <label for="phy_zip">ZIP Code</label>
                    <input type="text" class="form-control" id="phy_zip" v-model="lead.phy_zip">
                </div>
                <div class="form-group">
                    <label for="nbr_power_unit">Number of Trucks</label>
                    <input type="text" class="form-control" id="nbr_power_unit" v-model="lead.nbr_power_unit">
                </div>
                <div class="form-group">
                    <label for="last_insurance_carrier">Last Insurance Carrier</label>
                    <input type="text" class="form-control" id="last_insurance_carrier" v-model="lead.last_insurance_carrier">
                </div>                             
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">Phone Number</label>
                    <input type="text" class="form-control" id="telephone" v-model="lead.telephone">
                </div>
                <div class="form-group">
                    <label for="dba_name">Company</label>
                    <input type="text" class="form-control" id="dba_name" v-model="lead.dba_name">
                </div>
                <div class="form-group">
                    <label for="phy_city">City</label>
                    <input type="text" class="form-control" id="phy_city" v-model="lead.phy_city">
                </div>
                <div class="form-group">
                    <label for="phy_state">State</label>
                    <input type="text" class="form-control" id="phy_state" v-model="lead.phy_state">
                </div>
                <div class="form-group">
                    <label for="driver_total">Number of Drivers</label>
                    <input type="text" class="form-control" id="driver_total" v-model="lead.driver_total">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" v-model="lead.description">
                </div>                   
            </div>
        </div>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="form-group lead-search">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="background:burlywood">Save Changes</button>
                    </span>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="background:burlywood">Dispatch</button>
                    </span>
                </div>
            </div>
        </div>        
    </form>

</template>

<script>
    import {mapGetters} from 'vuex'

    export default {

        name: "Lead",
        data() {
            return {
                dot_number: '1000261',
                // legal_name: '',
                // telephone: '',
                // email_address: '',
                // dba_name: '',
                // phy_street: '',
                // phy_city: '',
                // phy_zip: '',
                // phy_state: '',
                // nbr_power_unit: '',
                // driver_total: '',
                // last_insurance_carrier: '',
                // description: '',
            }
        },
        mounted() {
            // this.$store.dispatch('fetchLead', dot_number)
        },
        methods: {
            fetchLead(id) {
                this.$store.dispatch('fetchLead', id)
            },
            deleteLead(id) {
                this.$store.dispatch('deleteLead', id)
            },
        },
        computed: {
            ...mapGetters([
                'lead'
            ])
        }

    }
</script>

<style scoped>
    .lead-search {
        padding: 1rem 0;
        /* width: 50%; */
    }

    #dot_number {
        margin: 0 1rem;
    }
</style>


