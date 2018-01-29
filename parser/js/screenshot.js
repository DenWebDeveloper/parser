$(document).ready(function() {
    $("#btn-screenshot").click(function(){
        html2canvas($(".list-price"), {
            onrendered: function(canvas) {
                canvas.toBlob(function(blob) {
                    saveAs(blob, "Dashboard.png");
                });
            }
        });
    });
});