var loadFile = function(event) {
    var image = document.getElementById('image');
    var replacement = document.getElementById('current-img');
    replacement.src = URL.createObjectURL(event.target.files[0]);
};

var loadbasicFile = function(id1,id2,event) {
    var image       = document.getElementById(id1);
    var replacement = document.getElementById(id2);
    replacement.src = URL.createObjectURL(event.target.files[0]);
};

$(document).ready(function () {
    createEditor('ckeditor-classic');
    createEditor('ckeditor-classic-background');
    createEditor('ckeditor-classic-direction');
});
function createEditor(id){
    ClassicEditor.create(document.querySelector("#"+id))
        .then( editor => {
            window.editor = editor;
            editor.ui.view.editable.element.style.height="200px";
            editor.model.document.on( 'change:data', () => {
                $( '#' + id).text(editor.getData());
            } );
        } )
        .catch(function(e){console.error(e)});
}