require('./bundle');

(function () {
    function init() {
        if (document.getElementById('media-root')) {
            TnMedia.default({
                id: 'media-root',
                popup: false,
                uploadAPI: route('media.files.upload'),
                listAPI: route('media.list'),
                createFolderAPI: route('media.folders.create'),
                deleteAPI: route('media.delete'),
                renameAPI: route('media.rename'),
            })
        }
    }

    init();

    $(document).on('pjax:complete', function () {
        init();
    });
})();