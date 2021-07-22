(function() {
    if (typeof $.pjax === 'function') {
        $(document).on('pjax:complete', function() {
            // renderSimplemde("editor-simplemde");
            $(document).find('.widget_item a.reload').trigger('click');
        })
    }

    $(document).ready(function() {
        if ($(document).find('.widget_item a.reload').length) {
            $(document).find('.widget_item a.reload').click();
        }
    });

    const templaceLoading = `
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="flex justify-center items-center h-full">
            <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
    `;

    $(document).on('click', '.widget_item a.reload', function(e) {
        e.preventDefault();

        const _self = $(this);
        const parent = _self.closest('.widget_item');
        const url = parent.data('url');

        const loading = $(templaceLoading).clone();

        parent.find('.widget-content').append(loading);

        axios.get(url).then(function(response) {
            parent.find('.widget-content').html(response.data);
        }).finally(() => {
            loading.remove()
        })
    })
})()