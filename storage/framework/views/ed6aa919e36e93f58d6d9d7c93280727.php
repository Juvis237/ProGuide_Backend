<div wire:ignore>
    <div
        x-data="{
            value: <?php if ((object) ($attributes->wire('model')) instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e($attributes->wire('model')->value()); ?>')<?php echo e($attributes->wire('model')->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e($attributes->wire('model')); ?>')<?php endif; ?>,
        }"
        type="textarea"
        x-ref="tinymce"
        x-init="
             tinymce.init({
                target: $refs.tinymce,
                toolbar: 'insertfile undo redo | styleselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | help | code',
                relative_urls: false,
                plugins: ' media code lists',
                remove_script_host : false,
                document_base_url: '<?php echo e(config('app.url')); ?>/',
                language: 'en',
                advcode_inline: true,
                setup: function(editor) {
                    editor.on('blur', function(e) {
                        value = editor.getContent()
                    })

                    editor.on('focus', function (e) {
                        $dispatch('textarea-focus');
                    });

                    editor.on('init', function (e) {
                        if (value != null) {
                            editor.setContent(value)
                        }
                    })

                    editor.on('paste', (e) => {
                        var imageBlob = getPastedImage(e);

                        if (!imageBlob) {
                            return;
                        }

                        e.preventDefault();

                        uploadPastedImage(imageBlob)
                            .then(response => response.json())
                            .then(data => {
                                if ('location' in data) {
                                    editor.insertContent(`<img src='${data.location}' />`);
                                }
                            });
                    });

                    function putCursorToEnd() {
                        editor.selection.select(editor.getBody(), true);
                        editor.selection.collapse(false);
                    }

                    $watch('value', function (newValue) {
                        if (newValue !== editor.getContent()) {
                            editor.resetContent(newValue || '');
                            putCursorToEnd();
                        }
                    });
                }


                });
                "
          <?php echo e($attributes); ?>

    >
        <div>
            <textarea
                x-ref="tinymce"
                type="textarea"
                <?php echo e($attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'w-full bg-cultured'])); ?>

            ></textarea>
        </div>
    </div>

</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/components/wysiwyg.blade.php ENDPATH**/ ?>