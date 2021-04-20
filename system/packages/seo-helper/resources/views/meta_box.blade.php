<div x-data="{open: false}"
     class="rounded-md bg-white border border-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
    <div>
        <div class="border-b px-6 py-3 flex justify-between dark:border-gray-700">
            <h3>
                Search Engine Optimize
            </h3>
            <a href="javascript:void(0)" x-on:click="open = !open">Edit SEO meta</a>
        </div>
        <p class="py-3 px-6 default-seo-description @if (!empty($object->id)) hidden @endif">
            Setup meta title & description to make your site easy to discovered on search engines such as Google
        </p>
        <div class="py-3 px-6 existed-seo-meta @if (empty($object->id)) hidden @endif">
            <span class="page-title-seo">
                {{ $meta['seo_title'] ?? (!empty($object->id) ? $object->name ?? $object->title : null) }}
            </span>
            <div class="page-url-seo ws-nm">
                <p>-</p>
            </div>
            <div class="page-description-seo ws-nm">
                {{ strip_tags($meta['seo_description'] ?? (!empty($object->id) ? $object->description : (!empty($object->id) && $object->content ? Str::limit($object->content, 250) : old('seo_meta.seo_description')))) }}
            </div>
        </div>
    </div>
    <div x-show:="open"
         class="py-3 px-6 space-y-4"
         style="display: none">
        <div class="flex flex-col">
            <label for="seo_title">SEO Title</label>
            {!! Form::text('seo_meta[seo_title]', $meta['seo_title'], [
    'data-counter' => 120,
     'id' => 'seo_title',
     'class' => 'px-4 py-2 border focus:ring-blue-400 focus:border-blue-500 w-full
      sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300']) !!}
        </div>
        <div class="flex flex-col">
            <label for="seo_description">SEO Description</label>
            {!! Form::textarea('seo_meta[seo_description]', $meta['seo_description'], [
    'id' => 'seo_description',
    'rows' => '3',
    'class' => 'px-4 py-2 border focus:ring-blue-400 focus:border-blue-500 w-full
     sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300'
]) !!}
        </div>
    </div>
</div>
<script>
    $(function() {
        function updateSEOTitle(value) {
            if (value) {
                if (!$('#seo_title').val()) {
                    $('.page-title-seo').text(value);
                }
                $('.default-seo-description').addClass('hidden');
                $('.existed-seo-meta').removeClass('hidden');
            } else {
                $('.default-seo-description').removeClass('hidden');
                $('.existed-seo-meta').addClass('hidden');
            }
        }

        function updateSEODescription(value) {
            if (value) {
                if (!$('#seo_description').val()) {
                    $('.page-description-seo').text(value);
                }
            }
        }

        $("input[name=name]").keyup(function() {
            updateSEOTitle($(this).val());
        })
        $("input[name=title]").keyup(function() {
            updateSEOTitle($(this).val());
        })
        $("textarea[name=description]").keyup(function() {
            updateSEODescription($(this).val());
        })
        $("#seo_title").keyup(function() {
            const value = $(this).val();
            if(value) {
                $('.page-title-seo').text(value);
                $('.default-seo-description').addClass('hidden');
                $('.existed-seo-meta').removeClass('hidden');
            } else {
                let $inputName = $('input[name=name]');
                if ($inputName.val()) {
                    $('.page-title-seo').text($inputName.val());
                } else {
                    $('.page-title-seo').text($('input[name=title]').val());
                }
            }
        })
        $("#seo_description").keyup(function(event) {
            const value = $(event.currentTarget).val();
            if (value) {
                $('.page-description-seo').text(value);
            }  else {
                $('.page-description-seo').text($('textarea[name=description]').val());
            }
        })
    })
</script>