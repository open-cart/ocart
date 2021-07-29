import {UploadController} from "../controllers/UploadController";
import {setData, request, error, success, doneRequest} from '../reducers'
import EventEmitter from "../common/EventEmitter";

export const getListFiles = () => dispatch => {
    dispatch(request());
    return UploadController.list().then(res => {
        dispatch(setData(res.items));
        return res;
    }).catch(err => {
        dispatch(error(err));
        return err;
    }).finally(() => {
        dispatch(doneRequest());
    })
}

export const uploadFile = (listFiles) => dispatch => {
    dispatch(request());

    return Promise.all(listFiles.map(file => UploadController.upload(file)))
        .then(res => {
            dispatch(getListFiles());
            return res;
        }).catch(err => {
            dispatch(error(err));
            return err;
        }).finally(() => {
            dispatch(doneRequest());
        });
}

export const createFolder = (name, parent_id) => dispatch => {
    dispatch(request());
    return UploadController.createFolder(name, parent_id)
        .then(res => {
            dispatch(getListFiles());
            return res;
        }).catch(err => {
            dispatch(error(err));
            return err;
        }).finally(() => {
            dispatch(doneRequest());
        });
}