let actions = {
    updateLead({commit, state}, id) {
        console.log(state)
        axios.post(`/api/lead/${id}`, state.lead)
            .then(res => {
                commit('UPDATE_LEAD', res.data)
            }).catch(err => {
            console.log(err)
        })

    },
    fetchLead({commit}, id) {      
        axios.get(`/api/lead/${id}`)
            .then(res => {
                commit('FETCH_LEAD', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteLead({commit}, id) {
        axios.delete(`/api/lead/${id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_LEAD', id)
            }).catch(err => {
            console.log(err)
        })
    }
}

export default actions