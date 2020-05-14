let actions = {

    updateLead({commit, state}, id) {

        commit('UPDATE_LEAD');
        axios.put(`/api/lead/${id}`, state.lead)
            .then(response => {
                commit('UPDATE_LEAD_SUCCESS', response.data);
                Vue.notify({
                    group: 'lead',
                    type: 'success',
                    title: 'SUCCESS!',
                    text: 'Lead successfuly saved in the database.'
                });

                commit('SEND_LEAD');
                axios.post(`/api/send-lead`, state.lead)
                    .then(response => {
                        commit('SEND_LEAD_SUCCESS', response.data);
                        if (response && response.data && response.data.error) {
                            Vue.notify({
                                group: 'lead',
                                type: 'warn',
                                title: 'Lead not sent to Bold Penguin',
                                text: response.data.error
                            });
                        } else {
                            Vue.notify({
                                group: 'lead',
                                type: 'success',
                                title: 'SUCCESS!',
                                text: 'Lead successfuly sent to Bold Penguin.'
                            });
                        }
                    }).catch(error => {
                        console.log("bp_error", error);
                    })

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
console.log("fetchLead", id)
        commit('FETCH_LEAD');
        axios.post(`/api/lead`, id)
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


    sendErEmail({commit, state}) {
        commit('UPDATE_LEAD');
        axios.put(`/api/lead/${state.lead.id}`, state.lead)
            .then(response => {
                commit('UPDATE_LEAD_SUCCESS', response.data);
                Vue.notify({
                    group: 'lead',
                    type: 'success',
                    title: 'SUCCESS!',
                    text: 'Lead successfuly saved in the database.'
                });
console.log('lead id', state.lead.id);                
                axios.post(`/api/send-er-email`, {'id' : state.lead.id})
                    .then(response => {
                        if (response && response.data && response.data.error) {
                            Vue.notify({
                                group: 'lead',
                                type: 'warn',
                                title: 'ER Mail not sent.',
                                text: response.data.error
                            });
                        }
                    }).catch(error => {
                        console.log("send_er_email_error", error);
                    })

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
    }
}

export default actions;