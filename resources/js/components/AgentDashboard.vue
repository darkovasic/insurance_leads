<template>
    <form>
        <slot></slot>
        <loading 
            :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="false">
        </loading>
        <notifications group="lead" />
        <v-dialog />
        <div class="row" style="background:cadetblue">
            <div class="col-md-6">
                <div class="input-group lead-search align-items-center">
                    <label for="dot_search" class="search-term">DOT Number</label>
                    <input type="text" class="form-control" id="dot_search" @keyup.enter="fetchLeadByDotNumber(dot_search)" :value="dot_search" @input="updateDotSearch">
                    <span class="input-group-btn">
                        <b-button @click="fetchLeadByDotNumber(dot_search)">Search</b-button>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group lead-search align-items-center">
                    <label for="phone_search" class="search-term">Phone</label>
                    <input type="text" class="form-control" id="phone_search" @keyup.enter="fetchLeadByPhoneNumber(phone_search)" :value="phone_search" @input="updatePhoneSearch">
                    <span class="input-group-btn">
                        <b-button @click="fetchLeadByPhoneNumber(phone_search)">Search</b-button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row" style="background:burlywood">
            <div class="col-md-4 form-column">
                <div class="form-group">
                    <label for="legal_name">Legal Name</label>
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

                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="nbr_power_unit"># Trucks</label>
                            <input type="number" class="form-control" id="nbr_power_unit" :value="nbr_power_unit" @input="updateNbrPowerUnit">
                            <small v:if="errors && errors.nbr_power_unit" class="text-danger">{{ getError(errors.nbr_power_unit) }}</small>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="driver_total"># Drivers</label>
                            <input type="number" class="form-control" id="driver_total" :value="driver_total" @input="updateDriverTotal">
                            <small v:if="errors && errors.driver_total" class="text-danger">{{ getError(errors.driver_total) }}</small>
                        </div>
                    </div>
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
            <div class="col-md-4 form-column">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" :value="first_name" @input="updateFirstName">
                            <small v:if="errors && errors.first_name" class="text-danger">{{ getError(errors.first_name) }}</small>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" :value="last_name" @input="updateLastName">
                            <small v:if="errors && errors.last_name" class="text-danger">{{ getError(errors.last_name) }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" :value="phone" @input="updateTelephone">
                    <small v:if="errors && errors.phone" class="text-danger">{{ getError(errors.phone) }}</small>
                </div>
                <div class="form-group">
                    <label for="dba_name">DBA Name</label>
                    <input type="text" class="form-control" id="dba_name" :value="dba_name ? dba_name : legal_name" @input="updateCompany">
                    <small v:if="errors && errors.dba_name" class="text-danger">{{ getError(errors.dba_name) }}</small>
                </div>
                <div class="form-group">
                    <label for="phy_city">City</label>
                    <input type="text" class="form-control" id="phy_city" :value="phy_city" @input="updateCity">
                    <small v:if="errors && errors.phy_city" class="text-danger">{{ getError(errors.phy_city) }}</small>
                </div>
                <div class="form-group">
                    <label for="phy_state">State</label>
                    <b-select id="phy_state" :options="state_hash" :value="phy_state" @input="updateState"></b-select>
                    <small v:if="errors && errors.phy_state" class="text-danger">{{ getError(errors.phy_state) }}</small>
                </div>
                <div class="form-group">
                    <label for="dot_number">DOT Number</label>
                    <input type="text" class="form-control" id="dot_number" :value="dot_number" @input="updateDriverTotal">
                    <small v:if="errors && errors.dot_number" class="text-danger">{{ getError(errors.dot_number) }}</small>
                </div>
                <div class="form-group">
                    <label for="last_insurance_date">Last Insurance Date</label>
                    <datepicker :typeable="false" type="text" input-class="form-control" id="last_insurance_date" :value="last_insurance_date" @selected="updateLastInsuranceDate"></datepicker>
                    <small v:if="errors && errors.last_insurance_date" class="text-danger">{{ getError(errors.last_insurance_date) }}</small>
                </div>
            </div>
            <div class="col-md-4 form-column">
                <div class="form-group">
                    <label for="full_time_employees">Full Time Employees</label>
                    <input type="number" class="form-control" id="full_time_employees" :value="full_time_employees" @input="updateFullTimeEmployees">
                    <small v:if="errors && errors.full_time_employees" class="text-danger">{{ getError(errors.full_time_employees) }}</small>
                </div>
                <div class="form-group">
                    <label for="part_time_employees">Part Time Employees</label>
                    <input type="number" class="form-control" id="part_time_employees" :value="part_time_employees" @input="updatePartTimeEmployees">
                    <small v:if="errors && errors.part_time_employees" class="text-danger">{{ getError(errors.part_time_employees) }}</small>
                </div>
                <div class="form-group">
                    <label for="currently_insured">Currently Insured</label>
                    <b-select id="currently_insured" :options="currently_insured_hash" :value="currently_insured" @input="updateCurrentlyInsured"></b-select>
                    <small v:if="errors && errors.currently_insured" class="text-danger">{{ getError(errors.currently_insured) }}</small>
                </div>
                <div class="form-group">
                    <label for="years_of_experience">Years of Experience</label>
                    <input type="number" class="form-control" id="years_of_experience" :value="years_of_experience" @input="updateYearsOfExperience">
                    <small v:if="errors && errors.years_of_experience" class="text-danger">{{ getError(errors.years_of_experience) }}</small>
                </div>
                <div class="form-group">
                    <label for="legal_entity">Legal Entity</label>
                    <b-select id="legal_entity" :options="legal_entity_hash" :value="legal_entity" @input="updateLegalEntity"></b-select>
                    <small v:if="errors && errors.legal_entity" class="text-danger">{{ getError(errors.legal_entity) }}</small>
                </div>
                <div class="form-group">
                    <label for="coverage_type">Coverage Type</label>
                    <b-select id="coverage_type" :options="coverage_type_hash" :value="coverage_type" @input="updateCoverageType"></b-select>
                    <small v:if="errors && errors.coverage_type" class="text-danger">{{ getError(errors.coverage_type) }}</small>
                </div>
                <div class="form-group">
                    <label for="insurance_cancellation_date">Insurance Cancelation Date</label>
                    <datepicker :typeable="false" type="text" input-class="form-control" id="insurance_cancellation_date" :value="insurance_cancellation_date" @selected="updateInsuranceCancellationDate"></datepicker>
                    <small v:if="errors && errors.insurance_cancellation_date" class="text-danger">{{ getError(errors.insurance_cancellation_date) }}</small>
                </div>
            </div>
        </div>
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
                    <b-button @click="showConfirmationModal">Send to Broker</b-button>
                    <!-- <b-button @click="callApi(lead)">Send to Broker</b-button> -->
                </div>
            </div>
        </div>
    </form>

</template>

<script>
    import {mapGetters, mapState} from 'vuex';
    import Datepicker from 'vuejs-datepicker';
    import Loading from 'vue-loading-overlay';
    import { BButton, BFormSelect } from 'bootstrap-vue';
    import { state_hash, currently_insured_hash, legal_entity_hash, coverage_type_hash } from '../store/constants'

    import 'vue-loading-overlay/dist/vue-loading.css';

    Vue.component('b-button', BButton);
    Vue.component('b-select', BFormSelect);

    export default {

        name: "AgentDashboard",
        data() {
            return {
                state_hash: state_hash,
                currently_insured_hash: currently_insured_hash,
                legal_entity_hash: legal_entity_hash,
                coverage_type_hash: coverage_type_hash
            }
        },
        mounted() {
        },
        methods: {
            showConfirmationModal () {
                this.$modal.show('dialog', {
                    title: 'Are you sure?',
                    text: 'Do you want to send this lead to the broker?',
                    buttons: [
                        {
                            title: 'Send',
                            handler: () => { this.updateLead(this.lead.id), this.hideConfirmationModal() },
                        },
                        {
                            title: 'Cancel',
                            default: true,
                        }
                    ],
                })
            },
            hideConfirmationModal () {
                this.$modal.hide('dialog');
            },

            fetchLeadByDotNumber(id) {
                let term = { dot_number: id };
                this.$store.dispatch('fetchLead', term);
            },
            fetchLeadByPhoneNumber(id) {
                let term = { phone: id };
                this.$store.dispatch('fetchLead', term);
            },
            updateLead(id) {            
                this.$store.dispatch('updateLead', id);
            },
            deleteLead(id) {
                this.$store.dispatch('deleteLead', id);
            },
            // callApi(lead) {
            //     this.$store.dispatch('callApi', lead);
            // },

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
            updateState(value) {
                this.$store.commit('updateState', value);
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
            updateDotSearch(e) {
                this.$store.commit('updateDotSearch', e.target.value);
            },
            updatePhoneSearch(e) {
                this.$store.commit('updatePhoneSearch', e.target.value);
            },
            updateFirstName(e) {
                this.$store.commit('updateFirstName', e.target.value);
            },
            updateLastName(e) {
                this.$store.commit('updateLastName', e.target.value);
            },
            updateFullTimeEmployees(e) {
                this.$store.commit('updateFullTimeEmployees', e.target.value);
            },
            updatePartTimeEmployees(e) {
                this.$store.commit('updatePartTimeEmployees', e.target.value);
            },
            updateCurrentlyInsured(value) {
                this.$store.commit('updateCurrentlyInsured', value);
            },
            updateYearsOfExperience(e) {
                this.$store.commit('updateYearsOfExperience', e.target.value);
            },
            updateLegalEntity(value) {
                this.$store.commit('updateLegalEntity', value);
            },
            updateCoverageType(value) {
                this.$store.commit('updateCoverageType', value);
            },
        },
        computed: {
            ...mapGetters([
                'lead',
                'errors',
                'isLoading'
            ]),
            ...mapState({
                phone: state => state.lead.phone,
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
                dot_search: state => state.dot_search,
                phone_search: state => state.phone_search,
                first_name: state => state.lead.first_name,
                last_name: state => state.lead.last_name,
                full_time_employees: state => state.lead.full_time_employees,
                part_time_employees: state => state.lead.part_time_employees,
                currently_insured: state => state.lead.currently_insured,
                years_of_experience: state => state.lead.years_of_experience,
                legal_entity: state => state.lead.legal_entity,
                coverage_type: state => state.lead.coverage_type,
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
    #dot_search, #phone_search {
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
    .btn-secondary {
        background:burlywood;
        color: #212529;
        border-color: burlywood;
    }
    .form-column {
        padding-top: 1rem;
    }
</style>


