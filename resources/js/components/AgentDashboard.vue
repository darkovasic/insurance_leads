<template>
    <form @submit.prevent="updateLead(dot_number)">
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="input-group lead-search align-items-center">
                    <label for="dot_number" class="search-term">DOT Number</label>
                    <input type="text" class="form-control" id="dot_number" @keyup.enter="fetchLead(dot_number)" :value="dot_number" @input="updateDotNumber">
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
                    <input type="text" class="form-control" id="legal_name" :value="legal_name" @input="updateLegalName">
                </div>
                <div class="form-group">
                    <label for="email_address">Email</label>
                    <input type="email" class="form-control" id="email_address" :value="email_address" @input="updateEmail">
                </div>
                <div class="form-group">
                    <label for="phy_street">Street</label>
                    <input type="text" class="form-control" id="phy_street" :value="phy_street" @input="updateStreet">
                </div>
                <div class="form-group">
                    <label for="phy_zip">ZIP Code</label>
                    <input type="text" class="form-control" id="phy_zip" :value="phy_zip" @input="updateZipCode">
                </div>
                <div class="form-group">
                    <label for="nbr_power_unit">Number of Trucks</label>
                    <input type="text" class="form-control" id="nbr_power_unit" :value="nbr_power_unit" @input="updateNbrPowerUnit">
                </div>
                <div class="form-group">
                    <label for="last_insurance_carrier">Last Insurance Carrier</label>
                    <input type="text" class="form-control" id="last_insurance_carrier" :value="last_insurance_carrier" @input="updateLastInsuranceCarrier">
                </div>                             
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">Phone Number</label>
                    <input type="text" class="form-control" id="telephone" :value="telephone" @input="updateTelephone">
                </div>
                <div class="form-group">
                    <label for="dba_name">Company</label>
                    <input type="text" class="form-control" id="dba_name" :value="dba_name" @input="updateCompany">
                </div>
                <div class="form-group">
                    <label for="phy_city">City</label>
                    <input type="text" class="form-control" id="phy_city" :value="phy_city" @input="updateCity">
                </div>
                <div class="form-group">
                    <label for="phy_state">State</label>
                    <input type="text" class="form-control" id="phy_state" :value="phy_state" @input="updateState">
                </div>
                <div class="form-group">
                    <label for="driver_total">Number of Drivers</label>
                    <input type="text" class="form-control" id="driver_total" :value="driver_total" @input="updateDriverTotal">
                </div>
                <div class="form-group">
                    <label for="last_insurance_date">Last Insurance Date</label>
                    <input type="text" class="form-control" id="last_insurance_date" :value="last_insurance_date" @input="updateLastInsuranceDate">
                </div>                                 
            </div>
        </div>
        <div class="row" style="background:burlywood">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" :value="description" @input="updateDescription">
                </div>   
            </div>
        </div>
        <div class="row" style="background:burlywood">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" :value="comment" @input="updateComment"></textarea>
                </div>
            </div>
        </div>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="input-group-btn lead-search float-right">
                    <button class="btn btn-default" type="submit" style="background:burlywood">Save Changes</button>
                    <button class="btn btn-default" type="button" style="background:burlywood">Send to Broker</button>
                </div>
            </div>
        </div>        
    </form>

</template>

<script>
    import {mapGetters, mapState} from 'vuex';

    export default {

        name: "AgentDashboard",
        data() {
            return {
        // add_date: null,
        // carrier_operation: null,
        // comment: null,
        // created_at: null,
        // dba_name: null,
        // description: null,
        // dot_number: 'null',
        // driver_total: null,
        // email_address: null,
        // fax: null,
        // hm_flag: null,
        // id: null,
        // last_insurance_carrier: null,
        // last_insurance_date: null,
        // legal_name: null,
        // mailing_city: null,
        // mailing_country: null,
        // mailing_state: null,
        // mailing_street: null,
        // mailing_zip: null,
        // mcs150_date: null,
        // mcs150_mileage: null,
        // mcs150_mileage_year: null,
        // nbr_power_unit: null,
        // oic_state: null,
        // pc_flag: null,
        // person_name: null,
        // phy_city: null,
        // phy_country: null,
        // phy_state: null,
        // phy_street: null,
        // phy_zip: null,
        // telephone: null,
        // updated_at: null,
                // lead: {},
            }
        },
        mounted() {

        },
        methods: {
            fetchLead(id) {
                this.$store.dispatch('fetchLead', id);
            },
            updateLead(id) {
                this.$store.dispatch('updateLead', id);
            },
            deleteLead(id) {
                this.$store.dispatch('deleteLead', id);
            },

            updateDotNumber(e) {
                this.$store.commit('updateDotNumber', e.target.value);
            },
            updateTelephone(e) {
                this.$store.commit('updateTelephone', e.target.value);
            },
            updateLegalName(e) {
                this.$store.commit('updateLegalName', e.target.value);
            },
            updateEmail(e) {
                this.$store.commit('updateEmail', e.target.value);
            },
            updateStreet(e) {
                this.$store.commit('updateStreet', e.target.value);
            },
            updateZipCode(e) {
                this.$store.commit('updateZipCode', e.target.value);
            },
            updateNbrPowerUnit(e) {
                this.$store.commit('updateNbrPowerUnit', e.target.value);
            },
            updateLastInsuranceCarrier(e) {
                this.$store.commit('updateLastInsuranceCarrier', e.target.value);
            },
            updateCompany(e) {
                this.$store.commit('updateCompany', e.target.value);
            },
            updateCity(e) {
                this.$store.commit('updateCity', e.target.value);
            },
            updateState(e) {
                this.$store.commit('updateState', e.target.value);
            },
            updateDriverTotal(e) {
                this.$store.commit('updateDriverTotal', e.target.value);
            },
            updateDescription(e) {
                this.$store.commit('updateDescription', e.target.value);
            },
            updateComment(e) {
                this.$store.commit('updateComment', e.target.value);
            },
            updateLastInsuranceDate(e) {
                this.$store.commit('updateLastInsuranceDate', e.target.value);
            },
        },
        computed: {
            ...mapGetters([
                'lead'
            ]),
            ...mapState({
                telephone: state => state.lead.telephone,
                legal_name: state => state.lead.legal_name,

                dot_number: state => state.lead.dot_number,
                email_address: state => state.lead.email_address,
                dba_name: state => state.lead.dba_name,
                phy_street: state => state.lead.phy_street,
                phy_city: state => state.lead.phy_city,
                phy_zip: state => state.lead.phy_zip,
                phy_state: state => state.lead.phy_state,
                nbr_power_unit: state => state.lead.nbr_power_unit,
                driver_total: state => state.lead.driver_total,
                last_insurance_carrier: state => state.lead.last_insurance_carrier,
                last_insurance_date: state => state.lead.last_insurance_date,
                comment: state => state.lead.comment,
                description: state => state.lead.description,
            })            
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
    label {
        margin-bottom: 0px;
    }
    .search-term {
        color: white;
        font-size: 16px;
        font-weight: 600;
    }
</style>


