let mutations = {
    UPDATE_LEAD(state, lead) {
        state.isLoading = true;
    },
    UPDATE_LEAD_SUCCESS(state) {
        state.errors = {};
        state.isLoading = false;
    },
    UPDATE_LEAD_ERROR(state, errors) {          
        state.errors = errors.errors;
        state.isLoading = false;
    },
    FETCH_LEAD(state, lead) {
        state.isLoading = true;
        state.errors = {};
        // state.lead = lead;
    },
    FETCH_LEAD_SUCCESS(state, lead) {
        state.lead = lead;
        state.isLoading = false;
    },
    FETCH_LEAD_ERROR(state, errors) {
        state.errors = errors.errors;
        state.isLoading = false;
    },
    DELETE_LEAD(state, lead) {
        let index = state.lead.findIndex(item => item.id === lead.id);
        state.lead.splice(index, 1);
    },
    SEND_LEAD(state) {
        state.isLoading = true;
        state.errors = {};
    },
    SEND_LEAD_SUCCESS(state) {
        state.isLoading = false;
    },

    updateDotNumber (state, dot_number) {
        state.lead.dot_number = dot_number;
    },
    updateTelephone (state, phone) {
        state.lead.phone = phone;
    },
    updateLegalName (state, legal_name) {
        state.lead.legal_name = legal_name;
    },
    updateEmail (state, email_address) {
        state.lead.email_address = email_address;
    },
    updateStreet (state, phy_street) {
        state.lead.phy_street = phy_street;
    },
    updateZipCode (state, phy_zip) {
        state.lead.phy_zip = phy_zip;
    },
    updateNbrPowerUnit (state, nbr_power_unit) {
        state.lead.nbr_power_unit = nbr_power_unit;
    },
    updateLastInsuranceCarrier (state, last_insurance_carrier) {
        state.lead.last_insurance_carrier = last_insurance_carrier;
    },
    updateLastInsuranceDate (state, last_insurance_date) {
        state.lead.last_insurance_date = last_insurance_date;
    },
    updateInsuranceCancellationDate (state, insurance_cancellation_date) {
        state.lead.insurance_cancellation_date = insurance_cancellation_date;
    },
    updateCompany (state, dba_name) {
        state.lead.dba_name = dba_name;
    },
    updateCity (state, phy_city) {
        state.lead.phy_city = phy_city;
    },
    updateState (state, phy_state) {
        state.lead.phy_state = phy_state;
    },
    updateDriverTotal (state, driver_total) {
        state.lead.driver_total = driver_total;
    },
    updateDescription (state, description) {
        state.lead.description = description;
    },
    updateComment (state, comment) {
        state.lead.comment = comment;
    },
    updateDotSearch (state, dot_search) {
        state.dot_search = dot_search;
    },
    updatePhoneSearch (state, phone_search) {
        state.phone_search = phone_search;
    },
    updateFirstName (state, first_name) {
        state.lead.first_name = first_name;
    },
    updateLastName (state, last_name) {
        state.lead.last_name = last_name;
    },
}

export default mutations