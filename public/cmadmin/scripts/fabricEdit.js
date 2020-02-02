$(document).ready(function(e){

            
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }});    

            $(function () {
                $('.select2').select2()
            });

            tinymce.init({
                selector: '.tiny_body',
                theme: 'modern',
                plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                image_advtab: true,
            });

            $('#image').change(function(){
                $('#fabric-image').html("");
                $('#fabric-image').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            }); 

            // Fabric Class
            $.ajax({
                url: "/fabric-class-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == fabric_class_id){
                            $('#fabric_class').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_class').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                        
                    });
                }
            });

            // Fabric Product Category
            $.ajax({
                url: "/product-category-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == product_category_id){
                            $('#product_category').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#product_category').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                        
                    });
                }
            });

            //Fabric Sub Category List
            var fs;
            
            listProductCategory(cat_id);

            $("#product_category").change(function(e) {
                e.preventDefault();
                var cat_id = $("#product_category").val();
                $('#product_sub_category').html("");
                listProductCategory(cat_id);
            });

            function listProductCategory(categoryId){
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: "/product-subcat-list",
                    type:'POST',
                    data: {_token:_token, id:categoryId},
                    dataType: 'json',
                    success:function(response){

                        $.each(response, function(key,value){
                            for (var k = 0; k < fabric_sub_categories.length; k++){
                                if(value.id == fabric_sub_categories[k]){
                                    $('#product_sub_category').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                                    fs = fabric_sub_categories[k]; 
                                }
                            }if(value.id != fs){
                                $('#product_sub_category').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                            
                        });
                    }
                });
            }
            
            //Fabric Color
            
            $.ajax({
                url: "/fabric-color-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == fabric_color_id){
                            $('#fabric_color').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_color').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                    });
                }
            });

            //Fabric Design
            
            $.ajax({
                url: "/fabric-design-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == fabric_color_id){
                            $('#fabric_design').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_design').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                    });
                }
            });

            //Fabric Material
            
            $.ajax({
                url: "/fabric-material-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == fabric_material_id){
                            $('#fabric_material').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_material').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                    });
                }
            });

            //Fabric Companies
            
            $.ajax({
                url: "/fabric-company-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == fabric_company_id){
                            $('#fabric_company').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_company').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                    });
                }
            });

            //Fabric Weight
            
            $.ajax({
                url: "/fabric-weight-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                        if(value.id == fabric_weight_id){
                            $('#fabric_weight').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_weight').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                    });
                }
            });

            //Fabric Softness
            
            $.ajax({
                url: "/fabric-softness-list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    $.each(response, function(key,value){
                       if(value.id == fabric_softness_id){
                            $('#fabric_softness').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                        }else{
                            $('#fabric_softness').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        }
                    });
                }
            });

            // Load Button Colors
            loadButtonColor();
            function loadButtonColor(){
                var current_button_color;
                $.ajax({
                    url: "/button-color-list",
                    type:'GET',
                    dataType: 'json',
                    success:function(response){
                        $.each(response, function(key,value){
                            for (var b = 0; b < button_colors.length; b++){
                                if(value.id == button_colors[b]){
                                    $('#button_color').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');  
                                    current_button_color = button_colors[b]; 
                                }
                            }if(value.id != current_button_color){
                                $('#button_color').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                            
                        });
                    }
                });
            }


            // fabricButtonSelect();
            function fabricButtonSelect(){
                var product_subs = [];
                var button_colors = [];
                var _token = $("input[name='_token']").val();
                $('#buttons').html("");
                $.each($("#product_sub_category option:selected"), function(){            
                    product_subs.push($(this).val());
                });
                $.each($("#button_color option:selected"), function(){            
                    button_colors.push($(this).val());
                });
                
                var a;
                var buttonz = String(button_colors);
                var product_sub_category = String(product_subs);
                $.ajax({
                    url: "/color-button-list",
                    type:'POST',
                    data: {_token:_token, buttons:buttonz, product_sub_category:product_sub_category},
                    dataType: 'json',
                    success:function(response){
                        $.each(response, function(key,value){
                            for (var i = 0; i < fabric_buttons.length; i++) {
                                if(value.id == fabric_buttons[i]){
                                    $('#buttons').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                                    a = fabric_buttons[i]; 
                                }
                            }
                            if(value.id != a){
                                $('#buttons').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                        });
                    }
                });
            }

            // $("#button_color").change(function(){

            //     var product_subs = [];
            //     var button_colors = [];
            //     var _token = $("input[name='_token']").val();

            //     $.each($("#product_sub_category option:selected"), function(){            
            //         product_subs.push($(this).val());
            //     });

            //     $.each($("#button_color option:selected"), function(){            
            //         button_colors.push($(this).val());
            //     });

            //     $('#buttons').html("");
            //     var buttonz = String(button_colors);
            //     var product_sub_category = String(product_subs);
            //     $.ajax({
            //         url: "/color-button-list",
            //         type:'POST',
            //         data: {_token:_token, buttons:buttonz, product_sub_category:product_sub_category},
            //         dataType: 'json',
            //         success:function(response){
            //             $.each(response, function(key,value){
            //             for (var i = 0; i < fabric_buttons.length; i++) {
            //                 if(value.id == fabric_buttons[i]){
            //                     $('#buttons').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
            //                     a = fabric_buttons[i]; 
            //                 }
            //             }
            //             if(value.id != a){
            //                 $('#buttons').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            //             }
            //             });
            //         }
            //     });
            // });
     
            //End Button Select
            //
            //Thread Color Listing 
            fabricThreadLoad();
            function fabricThreadLoad(){
                
                var current_thread;
                $.ajax({
                    url: "/fabric-thread-color",
                    type:'GET',
                    dataType: 'json',
                    success:function(response){
                        $.each(response, function(key,value){
                            for (var j = 0; j < thread_colors.length; j++){
                                if(value.id == thread_colors[j]){
                                    $('#fabric_thread').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                                    current_thread = thread_colors[j]; 
                                }
                            }if(value.id != current_thread){
                                $('#fabric_thread').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                            
                        });
                    }
                });
            }

            
        });