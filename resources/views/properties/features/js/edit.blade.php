
<script>
    $(document).ready(function(){
         //for add new feature
         @include('messages.jquery-messages')
         @include('common.hideshow-language-inputs')
         MakeMenuActive('#c_properties', '#features', '#cms_anchor');
         GrandMenuActive('#c_properties_1');
         $('#icon').change(function(){
            $('#show_icon').attr('class', `${$(this).val()} text-primary ml-5`);
         });


         //for add new staff
        $('#add_language').click(function(){
            const title_english = $(`#title_english_${input_id}`).val();
            var languages = $("input[name='languages[]']").map(function(){return $(this).val();}).get();
            var titles = $("input[name='title_english[]']").map(function(){return $(this).val();}).get();
            //applying validations here
             if(!title_english || !$.trim(title_english).length){
                 $('#title_english_error').html("The amenity title field is required.");
                 hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                 return $('#title_english').focus()
            }else if(title_english.length < 3){
                hideInputs();
                $('.btn_lang').attr('class', 'btn btn_lang mt-3 btn-cherwell lang-buttons');
                $(`#div_${input_id}`).attr('class', 'col-md-6 mb-3');
                return $('#title_english_error').html("The amenity title field must be at least 3 character.");
            }else{
                $('#title_english_error').html("");

                var formData = new FormData();
                formData.append('id',"{{ $storedData[0]->id }}");
                formData.append('title_english',title_english);
                formData.append('languages_names',languages);
                formData.append('titles',titles);
                formData.append('_token',_token);



                 $.ajax({
                     url:"{{ route('manage-properties.property-settings.features.edit-process') }}",
                     method:"POST",
                     data:formData,
                     contentType:false,
                     processData:false,
                     cache:false,
                     beforeSend:function()
                    {
                        $('#add_language').html(`${save_icon} @lang('translation.please_wait')`);
                        $('#add_language').attr('class',`${btn_cherwell } btn-block  ${spinner}`);
                        $('#add_language').attr('disabled',true);
                    },
                    complete:function()
                    {
                        $('#add_language').html(`${save_icon} @lang('translation.update')`);
                        $('#add_language').attr('class',`${btn_cherwell } btn-block`);
                        $('#add_language').removeAttr('disabled');
                    },
                     success:function(res){
                        //return console.log(res);
                       if(res == "true"){
                        ToastSuccess("Feature Updated Successfully");
                       }else if(res == 'title'){
                        $('#title_english_error').html("This feature title is already exist.");
                        $('#title_english').focus();
                       }

                     },error:function(xhr){
                         console.log(xhr.responseText);
                     }
                 });


            }
        });


    });
</script>
