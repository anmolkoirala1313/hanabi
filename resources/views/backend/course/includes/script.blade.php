<script>
    var classicEditorInstances = []; // Object to store Classic Editor instances

    function createEditor ( elementId ) {
        return ClassicEditor
            .create( document.querySelector( '#' + elementId ), {
                toolbar : {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'insertTable', 'blockQuote', '|',
                        'undo', 'redo'
                    ],
                },
                link: {
                    // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                    addTargetToExternalLinks: true,

                    // Let the users control the "download" attribute of each link.
                    decorators: [
                        {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'download'
                            }
                        }
                    ]
                },
            } )
            .then( editor => {
                classicEditorInstances[elementId] = editor; // Store the editor instance
                window.editor = editor;
                editor.model.document.on( 'change:data', () => {
                    $( '#' + elementId).text(editor.getData());
                } );

            } )
            .catch( err => {
                console.error( err.stack );
            } );
    }
    $(document).ready(function () {
        $('.select2').select2();
        createEditor('icon_description');
    });

    var counter = 0;
    $('#multi-field-wrapper').each(function() {
        var $wrapper = $('#multi-fields', this);

        //disable the delete button if the cloned div is just one
        clonecount = $('.multi-field').length;
        if(clonecount == 1){
            $('.remove-field').addClass('add-disabled');
        }

        $("#add-field", $(this)).click(function(e) {
            e.preventDefault();
            counter++;
            clonecount = clonecount + 1;
            //remove the disable option for button once the cloned div is more than 1
            if(clonecount > 1){
                $('.remove-field').removeClass('add-disabled');
            }
            if(clonecount > 7){
                $('#add-field').addClass('add-disabled');
            }

            let current_id = $('.multi-field:last-child', $wrapper).find('textarea').attr('id');
            // Get the editor container element using its ID and destroy before cloning
            destroyClassicEditor(current_id);


            //clone the element and add the id to div to make select field unique.
            var newElem = $('.multi-field:last-child', $wrapper).clone(true).appendTo($wrapper).attr('id', 'cloned-' + counter).find("input").val("");
            //remove the initial id from select and add new ID
            $('.multi-field').find('textarea').last().removeAttr('id').attr('id', 'clone-textarea-' + counter).val('');

            //create editors
            createEditor(current_id);
            createEditor( $('.multi-field').find('textarea').last().attr('id'));

        });

        $('.multi-field .remove-field', $wrapper).click(function(e) {
            e.preventDefault();
            clonecount = clonecount - 1;
            if(clonecount < 8){
                $('#add-field').removeClass('add-disabled');
            }
            if(clonecount == 1){
                $('.remove-field').addClass('add-disabled');
            }else if (clonecount > 1){
                $('.remove-field').removeClass('add-disabled');
            }
            if ($('.multi-field', $wrapper).length > 1){
                $(this).parent('.input-group').parent('.multi-field').remove();
            }
        });

        // Destroy the Classic Editor instance for a given textarea
        function destroyClassicEditor(textareaId) {
            if (classicEditorInstances[textareaId]) {
                classicEditorInstances[textareaId].destroy().then(function() {
                    console.log('Editor destroyed for ' + textareaId);
                }).catch(function(error) {
                    console.error(error);
                });
            }
        }
    });
</script>
