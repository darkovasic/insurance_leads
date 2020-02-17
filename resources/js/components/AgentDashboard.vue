<template>
    <form>
        <notifications group="lead" />
        <loading 
            :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="false">
        </loading>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="input-group lead-search align-items-center">
                    <label for="dot_number" class="search-term">DOT Number</label>
                    <input type="text" class="form-control" id="dot_number" @keyup.enter="fetchLead(dot_number)" :value="dot_number" @input="updateDotNumber">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" @click="fetchLead(dot_number)">Search</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row" style="background:burlywood">
            <div class="col-md-6 form-column">
                <div class="form-group">
                    <label for="legal_name">Contact Name</label>
                    <input type="text" class="form-control" id="legal_name" :value="legal_name" @input="updateLegalName">
                    <small v:if="errors && errors.legal_name" class="text-danger">{{ getError(errors.legal_name) }}</small>
                </div>
                <div class="form-group">
                    <label for="email_address">Email</label>
                    <input type="email" class="form-control" id="email_address" :value="email_address" @input="updateEmail">
                    <small v:if="errors && errors.email_address" class="text-danger">{{ getError(errors.email_address) }}</small>
                </div>
                <div class="form-group">
                    <label for="phy_street">Street</label>
                    <input type="text" class="form-control" id="phy_street" :value="phy_street" @input="updateStreet">
                    <small v:if="errors && errors.phy_street" class="text-danger">{{ getError(errors.phy_street) }}</small>
                </div>
                <div class="form-group">
                    <label for="phy_zip">ZIP Code</label>
                    <input type="text" class="form-control" id="phy_zip" :value="phy_zip" @input="updateZipCode">
                    <small v:if="errors && errors.phy_zip" class="text-danger">{{ getError(errors.phy_zip) }}</small>
                </div>
                <div class="form-group">
                    <label for="nbr_power_unit">Number of Trucks</label>
                    <input type="text" class="form-control" id="nbr_power_unit" :value="nbr_power_unit" @input="updateNbrPowerUnit">
                    <small v:if="errors && errors.nbr_power_unit" class="text-danger">{{ getError(errors.nbr_power_unit) }}</small>
                </div>
                <div class="form-group">
                    <label for="last_insurance_carrier">Last Insurance Carrier</label>
                    <input type="text" class="form-control" id="last_insurance_carrier" :value="last_insurance_carrier" @input="updateLastInsuranceCarrier">
                    <small v:if="errors && errors.last_insurance_carrier" class="text-danger">{{ getError(errors.last_insurance_carrier) }}</small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" :value="description" @input="updateDescription">
                    <small v:if="errors && errors.description" class="text-danger">{{ getError(errors.description) }}</small>
                </div>                           
            </div>
            <div class="col-md-6 form-column">
                <div class="form-group has-error">
                    <label for="telephone">Phone Number</label>
                    <input type="text" class="form-control" id="telephone" :value="telephone" @input="updateTelephone">
                    <small v:if="errors && errors.telephone" class="text-danger">{{ getError(errors.telephone) }}</small>
                </div>
                <div class="form-group">
                    <label for="dba_name">Company</label>
                    <input type="text" class="form-control" id="dba_name" :value="dba_name" @input="updateCompany">
                    <small v:if="errors && errors.dba_name" class="text-danger">{{ getError(errors.dba_name) }}</small>
                </div>
                <div class="form-group">
                    <label for="phy_city">City</label>
                    <input type="text" class="form-control" id="phy_city" :value="phy_city" @input="updateCity">
                    <small v:if="errors && errors.phy_city" class="text-danger">{{ getError(errors.phy_city) }}</small>
                </div>
                <div class="form-group">
                    <label for="phy_state">State</label>
                    <input type="text" class="form-control" id="phy_state" :value="phy_state" @input="updateState">
                    <small v:if="errors && errors.phy_state" class="text-danger">{{ getError(errors.phy_state) }}</small>
                </div>
                <div class="form-group">
                    <label for="driver_total">Number of Drivers</label>
                    <input type="text" class="form-control" id="driver_total" :value="driver_total" @input="updateDriverTotal">
                    <small v:if="errors && errors.driver_total" class="text-danger">{{ getError(errors.driver_total) }}</small>
                </div>
                <div class="form-group">
                    <label for="last_insurance_date">Last Insurance Date</label>
                    <datepicker :typeable="false" type="text" input-class="form-control" id="last_insurance_date" :value="last_insurance_date" @selected="updateLastInsuranceDate"></datepicker>
                    <small v:if="errors && errors.last_insurance_date" class="text-danger">{{ getError(errors.last_insurance_date) }}</small>
                </div> 
                <div class="form-group">
                    <label for="insurance_cancellation_date">Insurance Cancellation Date</label>
                    <datepicker :typeable="false" type="text" input-class="form-control" id="insurance_cancellation_date" :value="insurance_cancellation_date" @selected="updateInsuranceCancellationDate"></datepicker>
                    <small v:if="errors && errors.insurance_cancellation_date" class="text-danger">{{ getError(errors.insurance_cancellation_date) }}</small>
                </div>                           
            </div>
        </div>
        <!-- <div class="row" style="background:burlywood">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" :value="description" @input="updateDescription">
                    <small v:if="errors && errors.description" class="text-danger">{{ getError(errors.description) }}</small>
                </div>
            </div>
        </div> -->
        <div class="row" style="background:burlywood">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" :value="comment" @input="updateComment"></textarea>
                    <small v:if="errors && errors.comment" class="text-danger">{{ getError(errors.comment) }}</small>
                </div>
            </div>
        </div>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="input-group-btn lead-search float-right">
                    <button class="btn btn-default" type="button" @click="updateLead(dot_number)">Save Changes</button>
                    <button class="btn btn-default" type="button">Send to Broker</button>
                </div>
            </div>
        </div>        
    </form>

</template>

<script>
    import {mapGetters, mapState} from 'vuex';
    import Datepicker from 'vuejs-datepicker';
    import Loading from 'vue-loading-overlay';

    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {

        name: "AgentDashboard",
        data() {
            return {

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

            getError(error) {
                if (error) return error[0];
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
            updateLastInsuranceDate(date) {
                this.$store.commit('updateLastInsuranceDate', date);
            },
            updateInsuranceCancellationDate(date) {
                this.$store.commit('updateInsuranceCancellationDate', date);
            },
        },
        computed: {
            ...mapGetters([
                'lead',
                'errors',
                'isLoading'
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
                insurance_cancellation_date: state => state.lead.insurance_cancellation_date,
                comment: state => state.lead.comment,
                description: state => state.lead.description,
            })            
        },
        components: {
            Datepicker,
            Loading
        }
    }
</script>

<style scoped>
    .lead-search {
        padding: 1rem 0;
    }
    #dot_number {
        margin: 0 1rem;
    }
    label {
        margin-bottom: 0px;
    }
    .search-term {
        color: white;
        font-size: 1rem;
        font-weight: 600;
    }
    .btn {
        background:burlywood;
    }
    .form-column {
        padding-top: 1rem;
    }
</style>


