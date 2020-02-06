let mutations = {
    UPDATE_LEAD(state, lead) {
console.log("UPDATE_LEAD", state.lead);      
        // state.lead.unshift(lead)
    },
    UPDATE_LEAD_ERROR(state, errors) {
console.log("UPDATE_LEAD_ERROR", errors.errors);       
        return state.errors = errors.errors;
    },
    FETCH_LEAD(state, lead) {
        return state.lead = lead;
    },
    DELETE_LEAD(state, lead) {
        let index = state.lead.findIndex(item => item.id === lead.id);
        state.lead.splice(index, 1);
    },

    updateDotNumber (state, dot_number) {
        state.lead.dot_number = dot_number;
    },
    updateTelephone (state, telephone) {
        state.lead.telephone = telephone;
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
}

export default mutations