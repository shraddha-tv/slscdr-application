
// **********************************************************************************************************
//                           Set All departments to the departments Array in State
// **********************************************************************************************************
export const set_dialog = (state) => {
    return state.dialog = !state.dialog
}

// **********************************************************************************************************
//                           Set All departments to the departments Array in State
// **********************************************************************************************************
export const set_edit_item = (state,item) => {
    return state.item = item
}

// **********************************************************************************************************
//                           Set All departments to the departments Array in State
// **********************************************************************************************************
export const set_all_items = (state, items) => {
    return state.itemList = items
}

// **********************************************************************************************************
//                           Set All departments to the departments Array in State
// **********************************************************************************************************
export const set_active_item = (state, item) => {
    return state.activeItem = item
}