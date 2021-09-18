<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo API - Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<!-- api section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h2 class="fw-bolder mb-4">Demo Api</h2>
                <ul class="list-category"></ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                <div class="table-category"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                <form action="" method="post" id="form-category">
                    <div class="form-group">
                        <label for="name">Category: </label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status: </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="0" checked>
                            <label class="form-check-label" for="inactive">
                                inactive
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="active" value="1">
                            <label class="form-check-label" for="active">
                                active
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnInsert" id="btnInsert">Insert</button>
                    <a href="#" class="btn btn-success btnUpdate" style="display: none">Update</a>
                    <button type="button" class="btn btn-secondary" name="btnUpdate" id="btnCancel"
                            style="display: none">Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        loadData();

        function loadData() {
            // $.get('http://127.0.0.1:8002/api/danh-muc', function (res) {
            //     if (res.code === 200) {
            //         let data = res.data;
            //         let _li = '';
            //         data.forEach(function (item) {
            //             _li += `<li>${item.name}<l/i>`;
            //         });
            //         $('.list-category').html(_li);
            //     }
            // });

            $.get('http://127.0.0.1:8002/api/danh-muc-view', function (res) {
                let data = res.data;
                $('.table-category').html(res);
            });
        }

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }

        $('#form-category').on('submit', function (e) {
            e.preventDefault();
            // alert('clicked');
            let request = $(this).serialize();
            $.post('http://127.0.0.1:8002/api/danh-muc', request, function (res) {
                if (res.code === 200) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'none');

                    $('#form-category')[0].reset();
                    loadData();
                } else {
                    printErrorMsg(res.error);
                }
            })
        });

        $(document).on('click', '.btnDelete', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let data = {'_token': '{{csrf_token()}}', '_method': 'DELETE'};
            if (confirm('Ban co chac xoa ?')) {
                $.post(url, data, function (res) {
                    if (res.code === 200) {
                        loadData();
                    } else {
                        alert(res.messages);
                    }
                });
            }
            return false;
        });

        $(document).on('click', '.btnEdit', function (e) {
            e.preventDefault();
            $('#btnInsert').hide();
            $.get($(this).attr('href'), function (res) {
                if (res.code === 200) {
                    $('#name').val(res.data.name);
                    $('input:radio[name="status"][value="' + res.data.status + '"]').prop('checked', true);
                    $('.btnUpdate').attr('href', "{{url('api/danh-muc')}}" + "/" + res.data.id);
                    $('.btnUpdate, #btnCancel').show();
                }
            });
            return false;
        })

        $(document).on('click', '.btnUpdate', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    _method: 'PUT',
                    name: $('#name').val(),
                    status: $('input:radio[name="status"]:checked').val()
                },
                success: function (res) {
                    if(res.code === 200){
                        loadData();
                        $('.btnUpdate, #btnCancel').hide();
                        $('#btnInsert').show();
                        $('#form-category')[0].reset();

                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display', 'none');
                    }else{
                        printErrorMsg(res.error);
                    }
                }
            })
        })

        $(document).on('click', '#btnCancel', function () {
            $('#btnInsert').show();
            $('.btnUpdate, #btnCancel').hide();
            $('#form-category')[0].reset();
        });
    });
</script>
</body>
</html>
