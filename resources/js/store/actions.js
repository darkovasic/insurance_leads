let actions = {
    updateLead({commit}, lead) {
        axios.lead('/api/lead', lead)
            .then(res => {
                commit('UPDATE_LEAD', res.data)
            }).catch(err => {
            console.log(err)
        })

    },
    fetchLead({commit}) {
        axios.get('/api/lead')
            .then(res => {
                commit('FETCH_LEAD', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteLead({commit}, lead) {
        axios.delete(`/api/lead/${lead.id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_LEAD', lead)
            }).catch(err => {
            console.log(err)
        })
    }
}

export default actions