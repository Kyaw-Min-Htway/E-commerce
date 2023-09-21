@extends('user.layouts.master');

@section('content')

<style>
    .about{
        width: 100%;
        padding: 78px 0px;
        background: #191919;
    }

    .about img{
        height: auto;
        width: 420px;
    }

    .about-text{
        width: 550px;
    }
    .main{
        width: 1130px;
        max-width: 95px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }
    .about-text h1{
        color: white;
        font-size: 80px;
        text-transform: capitalize;
        margin-bottom: 20px;
    }
    .about-text h5{
        color: white;
        font-size: 25px;
        text-transform: capitalize;
        margin-bottom: 25px;
        letter-spacing: 2px;
    }

    span{
        color: #f9004d;
    }

    .about-text p{
        color: #fcfc;
        letter-spacing: 1px;
        line-height: 28px;
        font-size: 18px;
        margin-bottom: 45px;
    }

    button{
        background: #f9004d;
        color: white;
        text-decoration: none;
        border: 2px solid transparent;
        font-weight: bold;
        padding: 13px 30px;
        border-radius: 30px;
        transition: .4s;
    }
    button:hover{
        background: transparent;
        border: 2px solid #f9004d;
        cursor: pointer;
    }
</style>
    <div class="container">
        <section class="about">
            <div class="main">
                <div class="about-text">
                    <h1>About Us</h1>
                    <img src="{{asset('admin/images/bg-title-01.jpg')}}">
                    <h5 class="mt-3">Developer<span>(Kyaw Min Htway)</span></h5>
                    <p>I am a full-stack web developer. I can provide clean code and pixel
                    perfect design. I also make the website more and more interactive with web animations.
                    <button type="button">Let's Talk</button>
                </div>
            </div>
        </section>
    </div>
@endsection
