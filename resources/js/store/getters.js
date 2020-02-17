let getters = {
    lead: state => {
        return state.lead;
    },
    errors: state => {
        return state.errors;
    },
    isLoading: state => {
        return state.isLoading;
    }    
}

export default getters