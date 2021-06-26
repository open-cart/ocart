<div class="grid grid-cols-12 gap-4">
    <input type="hidden" name="deleted_nodes">
    <textarea name="menu_nodes" class="hidden" id="nestable-output"></textarea>
    <div class="hidden" id="nestable-input" data-input='@json($menu_nodes)'></div>

    <div class="col-span-4 space-y-4">
        @php do_action(MENU_ACTION_SIDEBAR_OPTIONS) @endphp

        <div class="bg-white rounded" x-data="{open: false}">
            <div class="px-4 py-3 flex justify-between cursor-pointer" x-on:click="open = !open">
                <h3>{{ trans('packages/menu::menus.add_link') }}</h3>
                <span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
            </div>
            <div x-show="open"
                 style="display: none"
                 id="external_link"
                 class="px-4 py-3 panel-group border-t">
                <div class="space-y-4 mb-3">
                    <label class="block ">
                        <span>{{ trans('packages/menu::menus.title') }}</span>
                        <x-input id="node-title" name="title" class="w-full"/>
                    </label>
                    <label class="block">
                        <span>{{ trans('packages/menu::menus.url') }}</span>
                        <x-input id="node-url" name="url" class="w-full"/>
                    </label>
                </div>
                <div class="flex justify-between">
                    <div></div>
                    <x-button type="button" class="btn-add-to-menu">
                        {{ trans('packages/menu::menus.add_to_menu') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-8 space-y-4">
        <div class="bg-white rounded">
            <h3 class=" px-4 py-3">{{ trans('Menu structure') }}</h3>
            <hr>
            <div class="nestable-menu p-4">
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
    .dd-list .dd-list { padding-left: 30px; }
    .dd-collapsed .dd-list { display: none; }
    .dd-item > button {
        display: none;
    }
    .dd-item {
        margin: 5px 0;
    }
    .dd-placeholder,
    .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
    .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
        background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
</style>