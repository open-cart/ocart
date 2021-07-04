import React from 'react';

import Icon from "../common/Icon";
import Button from "../common/Button";
import withConfig from "../common/WithConfig";
import {useDispatch} from "react-redux";
import {uploadFile} from "../actions"

function ButtonUpload({config, name}) {
    const inputRef = React.useRef(null);
    const dispatch = useDispatch();

    const onChange = (e) => {
        const files = e.target.files;
        if (files.length > 0) {
            const listFiles = [];
            for (const file of files) {
                listFiles.push(file);
            }

            dispatch(uploadFile(listFiles));
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
            <Button onClick={() => inputRef.current.click()}
                    icon={<Icon name="upload"/>}>
                Tải lên
            </Button>
        </>
    )
}

export default withConfig(ButtonUpload)