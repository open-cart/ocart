import {HttpClient} from "./HttpClient";

export class UploadController {
    static upload(file, parent_id = '0') {
        const formData = new FormData();
        formData.append("file[]", file);
        formData.append("parent_id", parent_id);

        return HttpClient.post(HttpClient.config.uploadAPI, formData)
    }

    static list() {
        return HttpClient.get(HttpClient.config.listAPI);
    }

    static createFolder(name, parent_id = '0') {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("parent_id", parent_id);
        return HttpClient.post(HttpClient.config.createFolderAPI, formData);
    }

    static rename() {}

    static deleteFile() {}
    static deleteFolder() {}
}