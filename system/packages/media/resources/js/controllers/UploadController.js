import {HttpClient} from "./HttpClient";

export class UploadController {
    static upload(file, parent_id = '0') {
        var formData = new FormData();
        formData.append("file[]", file);
        formData.append("parent_id", parent_id);

        return HttpClient.post(HttpClient.config.uploadAPI, formData)
    }

    static list() {
        return HttpClient.get(HttpClient.config.listAPI);
    }
}