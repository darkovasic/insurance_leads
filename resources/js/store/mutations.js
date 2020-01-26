let mutations = {
    UPDATE_LEAD(state, lead) {
        state.lead.unshift(lead)
    },
    FETCH_LEAD(state, lead) {
        return state.lead = lead
    },
    DELETE_LEAD(state, lead) {
        let index = state.lead.findIndex(item => item.id === lead.id)
        state.lead.splice(index, 1)
    }

}

export default mutations