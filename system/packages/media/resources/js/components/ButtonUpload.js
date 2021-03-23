import React from 'react';

import Icon from "../common/Icon";
import Button from "../common/Button";
import withConfig from "../common/WithConfig";
import {UploadController} from "../controllers/UploadController";
import EventEmitter from "../common/EventEmitter";

function ButtonUpload({config, name}) {
    const inputRef = React.useRef(null);

    const onChange = (e) => {
        const files = e.target.files;
        if (files.length > 0) {
            const listFiles = [];
            for (const file of files) {
                listFiles.push(file);
            }

            EventEmitter.emit('before');
            Promise.all(listFiles.map(file => UploadController.upload(file))).then(() => {
                console.log('upload success');
                EventEmitter.emit('refresh');
            }).finally(() => {
                EventEmitter.emit('after');
            })
        }
    }

    return (
        <>
            <input
                ref={inputRef}
                onChange={onChange}
                type="file"
                multiple
                style={{display: "none"}}/>
            <Button onClick={() => {
                inputRef.current.click();
            }} icon={<Icon name="upload"/>}>
                Tải lên
            </Button>
        </>
    )
}

export default withConfig(ButtonUpload)