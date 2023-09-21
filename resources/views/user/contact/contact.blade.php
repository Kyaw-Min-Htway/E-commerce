@extends('user.layouts.master');

@section('content')
    <style>
    .container{
        background: #e8e8e8;
    }
    .form-area{
        padding-top: 5%;
    }
    .row.single-form{
        box-shadow: 0 2px 20px -5px rgba(0,0,0,0,5);
        background: #fff;
    }
    .left{
        background: blueviolet;
        padding: 200px 98px;
    }
    .left h2{
        font-family: poppins;
        color: #fff;
        font-weight: 700;
        font-size: 48px;
    }
    .left h2 span{
        font-weight: 100;
    }
    .right{
        padding: 70px 100px;
        position: relative;
    }
    .right i{
        position: absolute;
        font-size: 80px;
        left: -27px;
        top: 40px;
        color: #fff;
    }

    .form-control{
        border: 2px solid #000;
    }

    .right button{
        border: none;
        border-radius: 0;
        background: #252525;
        width: 180px;
        color: #fff;
        padding: 15px 0;
        display: inline-block;
        font-size: 16px;
        margin-top: 20px;
        cursor: pointer;
    }

    .right button:hover{
        background : #2525252;
    }

    @media (min-width: 768px) and (max-width:991px){
        .right i{
            top: -52px;
            transform: rotate(9deg);
            left: 50deg;
        }
    }

    @media (max-width:767px){
        .left{
            padding: 90px 15px;
            text-align: center;
        }
        .left h2{
            font-size:25px;
        }
        .right{
            padding:25px;
        }
        .right i{
            top: -25px;
            transform: rotate(90deg);
            left: 45%;
        }
        .right button{
            width:150px;
            padding:12px 0;
        }
    }
    </style>
   <div class="form-area">
        <div class="container">
            <div class="row single-form g-5">
                <div class="col-sm-12 col-lg-6">
                    <div class="left">
                        <h2><span>Contact Us For</span><br>Business Enquiries</h2>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <i class="fa fa-caret-left"></i>
                        <form action="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
                                <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputMessage" class="form-label">Message</label>
                               <textarea name="message" id="exampleInputMessage" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="" id="exampleCheck" class="form-check-input">
                                <label for="exampleCheck" class="form-check-label">Check me out</label>

                            </div>
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        </form>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('jsScript')
   <script>
    $(document).ready(function(){
        $('#submit').click(function(){
            $source = {
                'name' : $('#exampleInputName').val(),
                'email' : $('#exampleInputEmail').val(),
                'message' : $('#exampleInputMessage').val()
            }
            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/ajax/message/list' ,
                data : $source,
                dataType : 'Json',
                success : function(response){
                    window.location.href = 'http://localhost:8000/user/home';
                }
            })
        })
    })
   </script>
@endsection
