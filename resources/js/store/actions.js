let actions = {
    updateLead({commit, state}, id) {
        commit('UPDATE_LEAD');
        console.log(state);
        axios.post(`/api/lead/${id}`, state.lead)
            .then(res => {
                commit('UPDATE_LEAD_SUCCESS', res.data);
            }).catch(error => {

                if (error.response.status === 422) {
                    // this.errors = error.response.data;
                    commit('UPDATE_LEAD_ERROR', error.response.data);
                    // this.loader = false;
                }
                
console.log("updateLead", this.errors);
            });

    },
    fetchLead({commit}, id) {      
        axios.get(`/api/lead/${id}`)
            .then(res => {
                commit('FETCH_LEAD', res.data)
            }).catch(error => {
            console.log("fetchLead", error)
        });
    },
    deleteLead({commit}, id) {
        axios.delete(`/api/lead/${id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_LEAD', id)
            }).catch(error => {
            console.log("deleteLead", error)
        });
    }
}

export default actions