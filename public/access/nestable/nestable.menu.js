$(document).ready(function () {
    function load() {
        const parent = $("#nestable");

        if (!parent.length) {
            return;
        }

        const menu_nodes = $("#nestable-input").data('input');

        var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (output) {
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            }
        };

        function recursive(data) {
            const refs = {0: []};
            for (const item of data) {
                const parent_id = item.parent_id || '0';

                if (!refs[parent_id]) {
                    refs[parent_id] = [];
                }
                refs[parent_id].push(item);
            }

            for (const item of data) {
                item.children = [];
                if (refs[item.id]) {
                    item.children = refs[item.id];
                }
            }

            return refs[0];
        }

        const nodes = recursive(menu_nodes);

        const templates = `
<div>
            <div class="bg-white border flex justify-between">
                <div class="dd-handle flex-grow flex justify-between px-3 py-2 cursor-move">
                    <div>Name</div>
                </div>
                <div class="flex-none flex flex justify-between items-center px-3">
                    <a class="show-item-details text-blue-500" href="javascript:void(0)">Edit</a>
                    <span>&nbsp;|&nbsp;</span>
                    <a class="delete-item text-blue-500" href="javascript:void(0)">Delete</a>
                </div>
            </div>
            <div style="display: none" class="item-details p-6 bg-white border-l border-r border-b">
                <div class="flex flex-col space-y-3">
                    <label class="flex items-center">
                        <span class="w-40 inline-block">Title</span>
                        <input name="title" type="text" class="border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900
 appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none 
  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300
  w-full"/>
                    </label>
                    <label class="flex items-center hidden">
                        <span class="w-40 inline-block">URL</span>
                        <input name="url" type="text" class="border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900
 appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none 
  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300
  w-full"/>
                    </label>
                    <label class="flex items-center">
                        <span class="w-40 inline-block">Target</span>
                        <select name="target" class="border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900
 appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none 
  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300
  w-full">
                            <option value="_self">Open link directly</option>
                            <option value="_blank">Open link new tab</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        `;

        function renderRecursive(nodes, parent) {
            for (const node of nodes) {
                const li = $(document.createElement('li'))
                li.html($(templates));
                li.addClass("dd-item block relative");
                li.data('id', node.id)
                li.data('title', node.title);
                // li.data('url', node.url);
                li.data('reference_type', node.reference_type);
                li.data('reference_id', node.reference_id);
                li.data('target', node.target);

                li.find('[name=title]').val(node.title);
                // li.find('[name=url]').val(node.url);
                li.find('[name=target]').val(node.target);
                li.find('.dd-handle').html(node.title);
                if (node.reference_type === 'custom-link') {
                    li.find('label.hidden').first().removeClass('hidden');
                    li.find('[name=url]').val(node.url);
                    li.data('url', node.url);
                }

                parent.children('ol').append(li);
                if (node.children?.length) {
                    const ul = $(document.createElement('ol'))
                    ul.addClass("dd-list");
                    li.append(ul)
                    ul.html(renderRecursive(node.children, li))
                }
            }
        }

        parent.on('change keyup', 'input[type="text"], select', function (e) {
            const _self = $(this);
            const li = _self.closest('li');
            const name = _self.attr('name');
            const value = e.target.value;

            li.data(name, value);

            updateOutput(parent.data('output', $('#nestable-output')));
        });
        parent.on('click', '.show-item-details', function (e) {
            const _self = $(this);
            const li = _self.closest('li');
            li.find('.item-details').first().toggle();
        })
        parent.on('click', '.delete-item', function (e) {
            const _self = $(this);
            const li = _self.closest('li');
            const id = li.data('id');
            let $elm = $('.form-save-menu input[name="deleted_nodes"]');

            if (id) {
                $elm.val($elm.val() + ',' + id);
            }

            li.remove();

            updateOutput(parent.data('output', $('#nestable-output')));
        })

        $('.btn-add-to-menu').click(function () {
            const _self = $(this);
            const panel = _self.closest('.panel-group');
            if (panel.attr('id') === 'external_link') {
                const title = $("#node-title").val();
                const url = $("#node-url").val();
                if (!title) {
                    return;
                }

                const li = $(document.createElement('li'));
                li.html($(templates));
                li.addClass("dd-item block relative");
                li.data('id', '')
                li.data('title', title);
                li.data('reference_type', 'custom-link');
                li.data('reference_id', 0);
                li.data('url', url);

                li.find('[name=title]').val(title);
                li.find('[name=url]').val(url);
                li.find('.dd-handle').html(title);

                li.find('label.hidden').removeClass('hidden');

                parent.children('ol').append(li);
            } else {
                panel.find('input:checked').each(function () {
                    const item = $(this).closest('li');
                    const data = item.data('item');
                    const type = item.data('type');

                    const li = $(document.createElement('li'))
                    li.html($(templates));
                    li.addClass("dd-item block relative");
                    li.data('id', '')
                    li.data('title', data.name);
                    li.data('reference_type', type);
                    li.data('reference_id', data.id);

                    li.find('[name=title]').val(data.name);
                    li.find('.dd-handle').html(data.name);

                    parent.children('ol').append(li);
                });
            }

            updateOutput(parent.data('output', $('#nestable-output')));
        })

        renderRecursive(nodes, parent);

        parent.nestable({
            group: 1
        }).on('change', updateOutput)

        updateOutput(parent.data('output', $('#nestable-output')));
    }

    load();

    if (typeof $.pjax === 'function') {
        $(document).on('pjax:complete', function() {
            load();
        })
    }
});