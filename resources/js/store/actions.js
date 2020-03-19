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
                        title: 'ERROR!',
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
                        title: 'Bummer',
                        text: 'Lead not found'
                    });
                }
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

    callApi({commit}, lead) {

        commit('SEND_LEAD');
        axios.post(`/api/send-lead`, lead)
            .then(response => {
                Vue.notify({
                    group: 'lead',
                    type: 'success',
                    title: 'SUCCESS!',
                    text: 'Lead successfuly sent to Bold Penguin.'
                });
                commit('SEND_LEAD_SUCCESS', response.data);
            }).catch(error => {
                console.log("bp_error", error);
            })
    }
}

export default actions;