$(function(){
    $.ajaxSetup({
        type: "POST"
    });
}).ajaxStart(function(){
    $(".loader").show();
}).ajaxStop(function(){
    $(".loader").hide();
});

function AddProduct() {
    var editor_data = CKEDITOR.instances.editor1.getData();
    var data = new FormData();
    var formInput = $(".addproduct").serializeArray();
    $.each( formInput, function(i,input) {
        data.append(input.name, input.value);
    });
        data.append('editor', editor_data);
        data.append('image', $('[type = file]').prop('value'));
        uploadInput = $('#image');
        data.append('file', uploadInput[0].files[0]);
    $.ajax({
        url: "addproduct",
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result) {
            if (!result.success) {
                str = "";
                if (result.title) str += result.title + "\n";
                //if (result.description) str += result.description + "\n";
                if (result.editor) str += result.editor + "\n";
                if (result.amount) str += result.amount + "\n";
                if (result.image)  str += result.image + "\n";
                AlertMsg('warning', str);
            } else {
                AlertMsg('success', result.success);
            }
        }
    });
}

function DeleteProduct(id) {
    if(confirm('Are you sure?')) {
        data = {
            id: id
        };
        $.ajax({
            url: "delete",
            data: data,
            success: function(result) {
                $("span." + id).detach();
                AlertMsg('warning', "Deleted: " + result);
            }
        });
    }
}

function MakeActive(id) {
    data = {
        id: id
    };
    $.ajax({
        url: "active",
        data: data,
        success: function(result) {
            switch(result) {
                case 'active':
                    $("span." + id + " a:last").removeClass("bg-danger").addClass("bg-success").text(result);
                    break;
                case 'hide':
                    $("span." + id + " a:last").removeClass("bg-success").addClass("bg-danger").text(result);
                    break;
            }
        }
    });
}

function EditProduct(id) {
    data = {
        id: id
    };
    if($("span." + id + " div.edit_place").is(":empty")) {
        $.ajax({
            url: "edit",
            data: data,
            success: function(result) {
                $("span." + id + " div.edit_place").html(result);
            }
        });
    } else {
        $("span." + id + " div.edit_place").empty();
    }
}