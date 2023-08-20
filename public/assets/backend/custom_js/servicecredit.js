var loadbasicFile = function(id1,id2,event) {
    var image       = document.getElementById(id1);
    var replacement = document.getElementById(id2);
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
