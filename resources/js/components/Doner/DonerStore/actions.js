// **********************************************************************************************************
//                           Get all Donation Records in database with Pagination
// **********************************************************************************************************
export const set_toggle_form = ({commit}) => {
    return commit('set_dialog')
}

// **********************************************************************************************************
//                           Get all Donation Records in database with Pagination
// **********************************************************************************************************
export const set_edit_item = ({commit},item) => {
    return commit('set_edit_item', item)
}

// **********************************************************************************************************
//                           Get all departments in database with Pagination
// **********************************************************************************************************
export const get_item_list = ({ commit },page) => {
    return new Promise((resolve, reject) => {
        axios.get(`api/doners?page=${page}`).then(response => {
            // Response data store the state array through mutation
            commit('set_all_items', response.data)
            resolve(response.data);
        }, error => {
            reject(error);
        })
    })
}
// **********************************************************************************************************
//                           Get all departments in database with Pagination
// **********************************************************************************************************
export const add_new_item = ({ commit },item) => {
    return new Promise((resolve, reject) => {
        axios.post('api/doners',item).then(response => {
            resolve(response.data);
        }, error => {
            reject(error);
        })
    })
}
// **********************************************************************************************************
//                           Get all departments in database with Pagination
// **********************************************************************************************************
export const update_exist_item = ({ commit },item) => {
    return new Promise((resolve, reject) => {
        axios.put(`api/doners/${item.id}`, item).then(response => {
            resolve(response.data);
        }, error => {
            reject(error);
        })
    })
}
// **********************************************************************************************************
//                           Get all departments in database with Pagination
// **********************************************************************************************************
export const get_item_details = ({ commit },id) => {
    return new Promise((resolve, reject) => {
        axios.get(`api/doners/${id}`).then(response => {
            // Response data store the state array through mutation
            commit('set_active_item', response.data)
            resolve(response.data);
        }, error => {
            reject(error);
        })
    })
}
// **********************************************************************************************************
//                           Get all departments in database with Pagination
// **********************************************************************************************************
export const delete_given_item = ({ commit },id) => {
    return new Promise((resolve, reject) => {
        axios.delete(`api/doners/${id}`).then(response => {
            resolve(response.data);
        }, error => {
            reject(error);
        })
    })
}