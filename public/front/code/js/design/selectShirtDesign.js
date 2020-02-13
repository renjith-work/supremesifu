$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

    $(document).on('click', '.load-design-modal', function(event){
        event.preventDefault();
        var id = $(this).attr('href');
        // console.log(id);
        loadDesignModal(id);
    });

    function loadDesignModal(id){

        $('#modal-design-image-cover').html('');
        $('#modal-design-detail-content').html('');

        $.ajax({
            url: "/design/load",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                console.log(response);
                $('#loadDesignDetails').modal('show');
                $('#modal-design-image-cover').append('<img src="/images/product/design/'+response.folder+'/'+response.p_image+'" alt=""> ');
                $('#modal-design-detail-content').append('<div class="modal-design-name">'+response.name+'</div><div class="modal-design-price">MYR '+response.price+' <span>MYR '+response.og_price+'</span></div><div class="modal-design-description"> '+response.summary+'</div>');
                $('#productDesign').val(response.id);
                $('#productFabric').val(fabric_id);
                loadPockets();
                loadMonograms();
            }
        });
    }


    function loadPockets(){
        $('#design_pocket').html('');
        $.ajax({
            url: "/api/product/design/shirt/pocket/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    if (value.value == "One") {
                        $('#design_pocket').append(' <div class="col-md-4"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_'+value.id+'" value="'+value.id+'" checked="checked"><label class="form-check-label modal-pocket-label">'+value.value+'</label></div></div>');
                    }else{
                        $('#design_pocket').append(' <div class="col-md-4"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_'+value.id+'" value="'+value.id+'"><label class="form-check-label modal-pocket-label">'+value.value+'</label></div></div>');   
                    }
                });
            }
        });
    }


    function loadMonograms(){
        $('#modal-monogram-cover').html('');
        $.ajax({
            url: "/api/product/design/monogram/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#modal-monogram-cover').append('<div class="monogram-item"><div class="measurement-head">'+value.name+' - <span>(Maximum of '+value.letter+' characters.)</span></div><div class="modal-monogram-body"><input type="text" id="'+value.code+'" name="'+value.code+'" class="monogram-input" placeholder="Maximum Of '+value.letter+' Letters"><div class="monogram-learn-link mobile-monogram-learn"><a href="#">What is a '+value.name+'?</a></div></div></div>');
                });
            }
        });
    }

});