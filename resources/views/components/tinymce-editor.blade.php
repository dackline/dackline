<div class="editor-wrapper" x-data="quillEditor('{{ $id }}')" x-bind:key="id" x-cloak>
    <textarea id="{{ $id }}" name="{{ $name }}">{!! $value !!}</textarea>
</div>

@pushonce('custom-scripts')
<script src="{{ asset(mix('vendors/js/editors/tinymce/tinymce.min.js')) }}"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('quillEditor', (id) => ({
            id: id,
            init() {
                tinymce.init({
                    selector: `#${this.id}`, // Replace this CSS selector to match the placeholder element for TinyMCE
                    menubar: false,
                    plugins: ['image', 'code', 'table', 'advlist', 'lists',],
                    toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link image media',
                    file_picker_callback : function(callback, value, meta) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                        var cmsURL = '{{ route('admin::unisharp.lfm.show') }}?editor=' + meta.fieldname;
                        if (meta.filetype == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.openUrl({
                            url : cmsURL,
                            title : 'Filemanager',
                            width : x * 0.8,
                            height : y * 0.8,
                            resizable : "yes",
                            close_previous : "no",
                            onMessage: (api, message) => {
                                callback(message.content);
                            }
                        });
                    },
                });
            },
        }))
    })
</script>
@endpushonce
