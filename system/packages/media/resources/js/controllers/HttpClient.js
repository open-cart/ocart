export class HttpClient {
    static getUrl(url) {
        return this.BASE_URL + '/' + this.trim(url);
    }

    static get(url, options = {}) {
        const defaultHeaders = {};
        defaultHeaders['Content-Type']='application/json';
        defaultHeaders['X-Requested-With']='XMLHttpRequest';
        defaultHeaders['X-CSRF-Token'] = document.head.querySelector("[name~=csrf-token][content]").content;

        options.headers = options.headers || {};
        options.headers = {...defaultHeaders, ...options.headers};

        return fetch(url, options).then(res => res.json());
    }

    static post(url, data, options = {}) {
        const defaultHeaders = {};
        // defaultHeaders['Content-Type']='application/json';
        defaultHeaders['X-Requested-With']='XMLHttpRequest';
        defaultHeaders['X-CSRF-Token'] = document.head.querySelector("[name~=csrf-token][content]").content;

        options.headers = options.headers || {};
        options.headers = {...defaultHeaders, ...options.headers};

        return fetch(url, {
            body: data,
            method: 'POST',
            ...options,
        }).then(res => res.json());
    }

    static trim(str) {
        return str.replace(/^\//g, '');
    }
}

HttpClient.BASE_URL = 'http://localhost';
HttpClient.config = {};