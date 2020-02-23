let actions = {
    updateLead({commit, state}, id) {
        commit('UPDATE_LEAD');
        axios.post(`/api/lead/${id}`, state.lead)
            .then(response => {
                commit('UPDATE_LEAD_SUCCESS', response.data);
                Vue.notify({
                    group: 'lead',
                    type: 'success',
                    title: 'SUCCESS!',
                    text: 'Lead successfuly saved in the database.'
                });
            }).catch(error => {
                if (error.response.status === 422) {
                    commit('UPDATE_LEAD_ERROR', error.response.data);
                    Vue.notify({
                        group: 'lead',
                        type: 'error',
                        title: 'DAMN!',
                        text: error.response.data.message
                    });
                }
            });
    },
    fetchLead({commit}, id) {  
        commit('FETCH_LEAD');
        axios.get(`/api/lead/${id}`)
            .then(response => {
                if (!response.data.id) {
                    Vue.notify({
                        group: 'lead',
                        type: 'warn',
                        title: 'Hmmm',
                        text: 'Lead not found!'
                    });
                }
                console.log("fetchLead", response);
                commit('FETCH_LEAD_SUCCESS', response.data);
            }).catch(error => {
                console.log("fetchLead", error);
                commit('FETCH_LEAD_ERROR', error.response.data);
        });
    },
    deleteLead({commit}, id) {
        axios.delete(`/api/lead/${id}`)
            .then(response => {
                if (response.data === 'ok')
                    commit('DELETE_LEAD', id);
            }).catch(error => {
            console.log("deleteLead", error);
        });
    },
    getPosts() {  
        axios.get(`/api/json-api`)
            .then(response => {
                console.log("getPosts", response);
            }).catch(error => {
                console.log("getPosts", error);
        });
    },    
}

export default actions;