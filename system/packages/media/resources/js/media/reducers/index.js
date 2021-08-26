import { createSlice } from '@reduxjs/toolkit'
import {UploadController} from "../controllers/UploadController";

export const counterSlice = createSlice({
    name: 'store',
    initialState: {
        value: [],
        loading: false,
    },
    reducers: {
        request: (state) => {
            state.loading = true;
        },
        error: (state, action) => {
            state.loading = false;
        },
        success: (state, action) => {
            state.loading = false;
        },
        doneRequest: (state) => {
            state.loading = false;
        },
        setData: (state, action) => {
            state.value = action.payload
        }
    },
})

// Action creators are generated for each case reducer function
export const { setData, request, error, success, doneRequest } = counterSlice.actions

export default counterSlice.reducer