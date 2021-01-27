<script src="/dashboard/vendor/jquery/jquery.min.js"></script>
<script src="/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/dashboard/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
<script src="/dashboard/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="/dashboard/vendor/chart.js/Chart.min.js"></script>
<script src="/dashboard/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/dashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/dashboard/js/charts-home.js"></script>
<!-- Main File-->
<script src="/dashboard/js/front.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        let buttons = document.getElementsByClassName('confirmation');
        for(let i=0; i<buttons.length; i++) {
            buttons[i].addEventListener("click", function (e) {
                e.preventDefault();
                bootbox.confirm({
                    message: '{{__('Do You Want To Delete This Item?')}}',
                    buttons: {
                        confirm: {
                            label: '{{__('Yes')}}',
                            className: 'btn-outline-dark rounded'
                        },
                        cancel: {
                            label: '{{__('No')}}',
                            className: 'btn-danger rounded'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            buttons[i].setAttribute('id','delete-form-true');
                            let aTag = document.getElementById('delete-form-true');
                            $(aTag).find('form').submit();
                        } else {
                        }
                    }
                });

            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#btn-verify').on('click', function () {
            let userId = $(this).attr('data-user');
            let data = {
                "user": userId,
                "_token": '{{ csrf_token() }}'
            };
            $.ajax({
                method: 'POST',
                url: '{{route('admin.verify')}}',
                dataType: "json",
                data: data,
                error: function (err) {
                    console.log(err);
                },
                success: function (data) {
                    $('#btn-verify').addClass('invisible');
                    $('#verified').html('{{__('Yes')}}');
                }
            })
        });
    });
</script>

<script>
   $(document).ready(function() {
           let buttons = document.getElementsByClassName('markread');
           let links = document.getElementsByClassName('read-link');
           for(let i=0; i<buttons.length; i++){
               buttons[i].addEventListener("click", function(){
                   let notificationId = buttons[i].getAttribute('data-notification');
                   let data = {
                       "notification": notificationId,
                       "_token": '{{ csrf_token() }}'
                   };
                   $.ajax({
                       method: 'POST',
                       url: '{{route('admin.notifications-mark-as-read')}}',
                       dataType: "json",
                       data: data,
                       error: function (err) {
                           console.log(err);
                       },
                       success: function (data) {
                           //links[i].setAttribute('class','text-gray read-link');
                           links[i].classList.remove('text-dark');
                           links[i].classList.add('text-gray');
                           buttons[i].classList.add('invisible');
                       }
                   })
               })
           }
   });

</script>
<script>
    function markNotificationAsRead(){
        $(document).ready(function() {
            let buttons = document.getElementsByClassName('read-link');
            for(let i=0; i<buttons.length; i++){
                buttons[i].addEventListener("click", function(){
                    let notificationId = buttons[i].getAttribute('data-notification');
                    let data = {
                        "notification": notificationId,
                        "_token": '{{ csrf_token() }}'
                    };
                    $.ajax({
                        method: 'POST',
                        url: '{{route('admin.notifications-mark-as-read')}}',
                        dataType: "json",
                        data: data,
                        error: function (err) {
                            console.log(err);
                        },
                        success: function (data) {
                            buttons[i].setAttribute('class','text-gray');
                        }
                    })
                })
            }
        });
    }
    markNotificationAsRead();
</script>

<script>
    $(document).ready(function() {
        $('#get-notifications').on('click', function () {
            let buttons = document.getElementsByClassName('read-link');
            let userId = $(this).attr('data-user');
            let data = {
                "user": userId,
                "_token": '{{ csrf_token() }}'
            };
            $.ajax({
                method: 'GET',
                url: '{{route('admin.notifications-get')}}',
                dataType: "json",
                data: data,
                error: function (err) {
                    console.log(err);
                },
                success: function (data) {
                    $('.notification-list').empty();
                    jQuery.each(data, function(i, val) {
                        if(val.length > 0){
                            jQuery.each(val, function(j, innerVal) {
                                let notificationText="";
                                //make notification text;
                                if (innerVal.type==='App\\Notifications\\SubmittedQuestionnaire'){
                                    let url = '{{route('admin.questionnaires.show',":id")}}';
                                    url = url.replace(":id",innerVal.data.QuestionnaireId);
                                    notificationText= innerVal.data.username +'{{__(' has submitted a new questionnaire')}}';
                                    let notificationHtml =$('<li><a style="white-space: normal;" rel="nofollow" href="'+url+'" class="dropdown-item read-link" data-notification="'+innerVal.id+'" >\n' +
                                        '                                            <div class="notification d-flex justify-content-between">\n' +
                                        '                                               <div class="notification-content"><i class="fa fa-flag fa-lg ml-1"></i>\n' + notificationText+
                                        '                                              </div>\n' +
                                        '                                           </div></a></li>');
                                    $('.notification-list').append(notificationHtml);
                                }
                                else if(innerVal.type==='App\\Notifications\\RegisteredUser'){
                                    let url = '{{route('admin.users.show',":id")}}';
                                    url = url.replace(":id",innerVal.data.userId);
                                    notificationText= innerVal.data.username +'{{__(' has joined us!')}}';
                                    let notificationHtml =$('<li><a rel="nofollow" href="'+url+'" class="dropdown-item read-link" data-notification="'+innerVal.id+'" >\n' +
                                        '                                            <div class="notification d-flex justify-content-between">\n' +
                                        '                                               <div class="notification-content"><i class="fa fa-user fa-lg ml-1"></i>\n' + notificationText+
                                        '                                              </div>\n' +
                                        '                                           </div></a></li>');
                                    $('.notification-list').append(notificationHtml);
                                }
                            });
                        }
                        else {
                            let notificationHtml =$('<li class="my-disabled"><a style="white-space: normal;" rel="nofollow" class="dropdown-item text-center text-gray">\n' +
                                'there are no unread notifications</a></li>');
                            $('.notification-list').append(notificationHtml);
                        }

                    });
                    markNotificationAsRead($('#get-notifications'));
                }
            })
        });
    });
</script>


<script>
    $(document).ready(function(){

        $('#project-username').keyup(function(){
            var query = $(this).val();
            if((query != '')&& (query.length>2))
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('admin.users.get-username-autocomplete')}}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#username-list').fadeIn();
                        $('#username-list').html(data);
                    }
                });
            }
            else {
            	$('#username-list').fadeOut();
            }
        });

        $(document).on('click', 'li', function(){
            if($(this).hasClass("auto-comp-li")){
                $('#project-username').val($(this).text());
                $('#username-list').fadeOut();
            }

        });

    });

    $(document).mouseup(function(e)
    {
        let input= $("#project-username");
        let list = $("#username-list");

        // if the target of the click isn't the container nor a descendant of the container
        if (!input.is(e.target) && input.has(e.target).length === 0)
        {
            list.hide();
        }
        else {
            list.show();
        }
    });
</script>

<script>
    function capitalizeFirstLetter(str) {
        return str.replace(/\w\S*/g, function(txt){
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }
    $(document).ready(function(){
        let locale = '{{\Illuminate\Support\Facades\Session::get('local')}}';
       $('#main-category').change(function () {
           let categoryId = $(this).val();
           getStyles($(this).val());
           let url = '{{route('categories',":id")}}';
           url = url.replace(":id",$(this).val());
           let data = {
               "category": categoryId,
               "_token": '{{ csrf_token() }}'
           };
           $.ajax({
               method: 'get',
               url: url,
               dataType: "json",
               data: data,
               error: function (err) {
                   console.log(err);
               },
               success: function (data) {
                   if(data.length>0){
                       $('#sub-category').empty();
                       $('#sub-category-1').fadeOut();
                       $('#sub-category-2').fadeOut();
                       $('#sub-category').fadeIn();
                       let content = '{{__('Select a Sub Category')}}';
                       let str= "<option value=\"\" disabled selected>"+content+"</option>";
                       $('#sub-category').append(str);
                       jQuery.each(data, function(i, val) {
                           let name="";
                       if(val.category_details != null){
                           if (locale=='ar'){
                               name= val.category_details.translations[0].name;
                           }
                           else {
                               name = capitalizeFirstLetter(val.category_details.translations[1].name);
                           }
                       }
                       else {
                           name =val.name;
                       }
                           $('#sub-category').append('<option value="'+val.id+'" >'+name+'</option>');

                       });
                   }
                   else {
                           $('#sub-category-1').fadeOut();
                           $('#sub-category-2').fadeOut();
                   }

               }
           })
       });
        // sub category
        $('#sub-category').change(function () {
            let categoryId = $(this).val();
            getStyles($(this).val());
            let url = '{{route('categories',":id")}}';
            url = url.replace(":id",$(this).val());

            let data = {
                "category": categoryId,
                "_token": '{{ csrf_token() }}'
            };
            $.ajax({
                method: 'get',
                url: url,
                dataType: "json",
                data: data,
                error: function (err) {
                    console.log(err);
                },
                success: function (data) {
                    if(data.length>0){
                        $('#sub-category-1').empty();
                        $('#sub-category-2').fadeOut();
                        $('#sub-category-1').fadeIn();
                        let content = '{{__('Select a Sub Category')}}';
                        let str= "<option value=\"\" disabled selected>"+content+"</option>";
                        $('#sub-category-1').append(str);
                        jQuery.each(data, function(i, val) {
                            let name="";
                            if(val.category_details != null){
                                if (locale=='ar'){
                                    name= val.category_details.translations[0].name;
                                }
                                else {
                                    name =capitalizeFirstLetter(val.category_details.translations[1].name);
                                }
                            }
                            else {
                                name = val.name;
                            }

                            $('#sub-category-1').append('<option value="'+val.id+'" >'+name+'</option>');
                        });
                    }
                    else{
                        $('#sub-category-1').fadeOut();
                        $('#sub-category-2').fadeOut();
                    }

                }
            })
        });
        // sub-catgory-2
        $('#sub-category-1').change(function () {
            let categoryId = $(this).val();
            getStyles($(this).val());
            let url = '{{route('categories',":id")}}';
            url = url.replace(":id",$(this).val());

            let data = {
                "category": categoryId,
                "_token": '{{ csrf_token() }}'
            };
            $.ajax({
                method: 'get',
                url: url,
                dataType: "json",
                data: data,
                error: function (err) {
                    console.log(err);
                },
                success: function (data) {
                    if (data.length>0){
                        $('#sub-category-2').empty();
                        $('#sub-category-2').fadeIn();
                        let content = '{{__('Select a Sub Category')}}';
                        let str= "<option value=\"\" disabled selected>"+content+"</option>";
                        $('#sub-category-2').append(str);
                        jQuery.each(data, function(i, val) {
                            let name="";
                            if(val.category_details != null){
                                if (locale=='ar'){
                                    name= val.category_details.translations[0].name;
                                }
                                else {
                                    name =capitalizeFirstLetter(val.category_details.translations[1].name);
                                }
                            }
                            else {
                                name = val.name;
                            }

                            $('#sub-category-2').append('<option value="'+val.id+'" >'+name+'</option>');
                        });

                    }
                    else {
                        $('#sub-category-2').fadeOut();
                    }
                }
            })
        });

        $('#sub-category-2').change(function () {
            getStyles($(this).val());
        });

        // Style
        function getStyles(id) {
                let categoryId =id;
                let url = '{{route('styles',":id")}}';
                url = url.replace(":id", id);
                let data = {
                    "category": categoryId,
                    "_token": '{{ csrf_token() }}'
                };
                $.ajax({
                    method: 'get',
                    url: url,
                    dataType: "json",
                    data: data,
                    error: function (err) {
                        console.log(err);
                    },
                    success: function (data) {
                        if (data.length > 0) {
                            $('#main-style').empty();
                            let content = '{{__('Select a Style')}}';
                            let str= "<option value=\"\" disabled selected>"+content+"</option>";
                            $('#main-style').append(str);
                            jQuery.each(data, function (i, val) {
                                $('#main-style').append('<option value="' + val.id + '" >' + val.name + '</option>');
                            });
                        } else {
                            $('#main-style').empty();
                            let content = '{{__('Select a Style')}}';
                            let str= "<option value=\"\" disabled selected>"+content+"</option>";
                            $('#main-style').append(str);
                        }
                    }
                })
        }
    });

</script>
<script>
    $(document).ready(function() {
        $('#btn-create').on('click', function () {
            let form = $('#my-form');
            if (form.valid() == true){
                form.submit();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#next-form').on('click', function () {
            let form = $('#my-form');
            form.validate({
                errorClass: "error-class",
                rules:{
                    username:{
                        required: true
                    },
                    name:{
                      required:true
                    },
                    address:{
                        required:true
                    },
                    main_category:{
                        required:true
                    },
                    project_director:{
                        required:true
                    }
                },
                messages:{
                    username:{
                        required:'{{__('* Project owner is required')}}'
                    },
                    name:{
                        required:'{{__('* Project name is required')}}'
                    },
                    address:{
                        required:'{{__('* Project address is required')}}'
                    },
                    main_category:{
                        required:'{{__('* Category of project is required')}}'
                    },
                    project_director:{
                        required:'{{__('* Project director is required')}}'
                    }
                }
            });
            if (form.valid() == true){
                current_fs = $('#first-form');
                next_fs = $('#second-form');
                $("#next-form").hide();
                current_fs.hide();
                $("#btn-cancel").hide();
                $(".loader").show().delay(1700).fadeOut();
                setTimeout(function(){
                    $("#previous-form").show();
                    next_fs.show();
                    $("#btn-cancel").show();
                    $("#btn-create").show();
                },2100);
            }
        });
    });
</script>

<script>
        $('#previous-form').click(function(){
            current_fs = $('#second-form');
            next_fs = $('#first-form');
            $(this).hide();
            current_fs.hide();
            $("#btn-cancel").hide();
            $("#btn-create").hide();
            $(".loader").show().delay(1000).fadeOut();
            setTimeout(function(){
            $("#next-form").show();
            next_fs.show();
            $("#btn-cancel").show();
        },1400);
    });
</script>

<script>
    $(function () {
        $(".loader1").show().delay(500).fadeOut();
        setTimeout(function(){
           $('#main-page').show();
        },1200);
    });
</script>


<script>
    $('#btn-add-member').click(function(){
        if (($('#member-name').val()!=="") && ($('#member-title').val()!==""))
        {
            $('#team-members-changed').val("1");
            // add to team list here
            let memberId = $('#member-id').val();
            if (memberId==""){
                memberId="NEW";
            }
            let str = " <li class=\"list-group-item team-member d-flex justify-content-between\" >" +
                "                                    <div>" +
                "                                     <b id=\"team-name-val\" class=\"ml-2\">"+$('#member-name').val()+"</b>"+" | "+"<span id=\"team-title-val\">"+ $('#member-title').val()+"</span>" +
                "                                    </div>" +
                    "<input type=\"hidden\" name=\"team-members-names[]\" value=\" "+$('#member-name').val()+"\" />"+
                    "<input type=\"hidden\" name=\"team-members-titles[]\" value=\" "+$('#member-title').val()+"\" />"+
                    "<input type=\"hidden\" name=\"team-members-ids[]\" value=\""+memberId+"\"/>"+
                "    <div class=\"flex d-flex mt-1\">" +
                    "     <span class=\"fa fa-edit ml-1 mr-2 team-list-buttons\" id=\"edit-team-member\"></span>" +
                    "     <span class=\"fa fa-trash mr-1 delete-btn team-list-buttons\" id=\"delete-team-member\"></span>" +
                "    </div>" +
                "                                    </li>";
            $('#add-your-team').hide().fadeOut;
            $('.team-list').append(str);
            $('#member-name').val("");
            $('#member-title').val("");
            $('#member-id').val("");
        }
        else if(($('#member-name').val()==="") && ($('#member-title').val()==="")){
            $('#error-member-name').show();
            $("#member-name").keyup(function () {
                $('#error-member-name').hide();
            });

            $('#error-member-title').show();
            $("#member-title").keyup(function () {
                $('#error-member-title').hide();
            });
        }
        else if ($('#member-name').val()==="") {
            $('#error-member-name').show();
            $("#member-name").keyup(function () {
                $('#error-member-name').hide();
            });
        }
            else if ($('#member-title').val()===""){
            $('#error-member-title').show();
            $("#member-title").keyup(function () {
                $('#error-member-title').hide();
            });
            }

    });
        // delete button
        $('.team-list').on('click', "#delete-team-member" , function(event) {
            $('#team-members-changed').val("1");
            $(this).parent().parent().fadeOut(500, function () {
                //$('#member-name').val();
                $(this).remove();
                if (document.getElementsByClassName("team-member").length ==1) {
                    $('#add-your-team').fadeIn(1500);
                }
            });

        });

    // edit button
    $('.team-list').on('click', "#edit-team-member" , function(event) {
        $(this).parent().parent().fadeOut(200, function () {
            let name = $(this).find('#team-name-val').html();
            $('#member-name').val(name);
            let title =$(this).find('#team-title-val').html();
            $('#member-title').val(title);
            let id=($(this).find('#member-id-val').val());
            $('#member-id').val(id);
            $(this).remove();
            if (document.getElementsByClassName("team-member").length ==1) {
                $('#add-your-team').fadeIn(1500);
            }
        });
    });

</script>

<script>
    $('#send-info-btn').on('click', function () {
        $(this).parent().parent().parent().submit();
    });
</script>

<script>
    // Close Project
    $('#close-project-btn').on('click', function (e) {
        e.preventDefault();
        bootbox.confirm({
            message: '{{__('Are You Confirmed About Closing This Project?')}}',
            buttons: {
                confirm: {
                    label: '{{__('Confirm')}}',
                    className: 'btn-submit rounded'
                },
                cancel: {
                    label: '{{__('Cancel')}}',
                    className: 'btn-danger rounded'
                }
            },
            callback: function (result) {
                if (result) {
                    //pressed yes
                    let projectId = $('#close-project-btn').attr('data-project');


                    $('#project-show-body').hide();
                    $('#project-action-dropdown').hide();
                    $('#close-project-btn').hide();
                    $('#project-move-loader').show().delay(2000).fadeOut();
                    setTimeout(function () {
                        $('#project-show-body').show();
                        $('#restore-project-btn').show();
                        $('#project-action-dropdown').show();
                    },2400);
                    let data = {
                        "project": projectId,
                        "_token": '{{ csrf_token() }}'
                    };
                    $.ajax({
                        method: 'POST',
                        url: '{{route('admin.projects.move-project')}}',
                        dataType: "json",
                        data: data,
                        error: function (err) {
                            console.log(err);
                        },
                        success: function (data) {

                        }
                    });
                } else {
                    //pressed no
                }
            }
        });
    });

    // Restore
    $('#restore-project-btn').on('click', function (e) {
        e.preventDefault();
        bootbox.confirm({
            message: '{{__('Are You Confirmed About Restoring This Project?')}}',
            buttons: {
                confirm: {
                    label: '{{__('Confirm')}}',
                    className: 'btn-submit rounded'
                },
                cancel: {
                    label: '{{__('Cancel')}}',
                    className: 'btn-danger rounded'
                }
            },
            callback: function (result) {
                if (result) {
                    //pressed yes
                    let projectId = $('#restore-project-btn').attr('data-project');

                    $('#project-show-body').hide();
                    $('#project-action-dropdown').hide();
                    $('#restore-project-btn').hide();
                    $('#project-move-loader').show().delay(2000).fadeOut();
                    setTimeout(function () {
                        $('#project-show-body').show();
                        $('#close-project-btn').show();
                        $('#project-action-dropdown').show();
                    },2400);
                    let data = {
                        "project": projectId,
                        "_token": '{{ csrf_token() }}'
                    };
                    $.ajax({
                        method: 'POST',
                        url: '{{route('admin.projects.restore-project')}}',
                        dataType: "json",
                        data: data,
                        error: function (err) {
                            console.log(err);
                        },
                        success: function (data) {
                        }
                    });
                } else {
                    //pressed no
                }
            }
        });
    });
</script>

<script>
    function readURL(input) {
        console.log();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#model-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            setTimeout(function () {
                $('#model-image').fadeIn();
            },1500);

        }
        else {
            $('#model-image').fadeOut();
        }
    }
    $("#model-image-input").change(function(){
        readURL(this);

    });
</script>


