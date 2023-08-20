var loadFile = function(event) {
    var image = document.getElementById('image');
    var replacement = document.getElementById('current-img');
    replacement.src = URL.createObjectURL(event.target.files[0]);
};

function slugMaker(title, slug){
    $("#"+ title).keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#"+slug).val(Text);
    });
}
$(document).ready(function () {
    createEditor('ckeditor-classic-blog');
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
