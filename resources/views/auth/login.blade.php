@extends('layouts.app')
@section('linkCss')
    <link rel="stylesheet" href="{{asset("css/login.css")}}">
@endsection
@section('content')

    <div class="video_back">

        <video autoplay loop muted>
            <source  src="{{asset('video/new.mp4')}}" type="video/mp4">
            <source  src="{{asset('video/new.mp4')}}" type="video/ogg">
        </video>
        <canvas id="canvas1"></canvas>

    </div>
    <div class="contain">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-end">تسجيل دخول</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="name" class="col-2 col-form-label text-center">الاسم</label>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="password" class="col-2 col-form-label text-center">الباسورد</label>
                        </div>

                       {{--<div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                       --}}
                        <div class="row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary" style="width: 150px">
                                    {{ __('Login') }}
                                </button>
                            {{--
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const canvas = document.getElementById("canvas1");
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let particlesArray;

    // get mouse position
    let mouse = {
        x: null,
        y: null,
        radius: (canvas.height/80) * (canvas.width/80)
    }

    window.addEventListener('mousemove',
        function(event) {
            mouse.x = event.x;
            mouse.y = event.y;
        }
    );

    // create particle
    class Particle {
        constructor(x, y, directionX, directionY, size, color) {
            this.x = x;
            this.y = y;
            this.directionX = directionX;
            this.directionY = directionY;
            this.size = size;
            this.color = color;
        }
        // method to draw individual particle
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = '#8C5523';
            ctx.fill();
        }
        // check particle position, check mouse position, move the particle, draw the particle
        update() {
            //check if particle is still within canvas
            if (this.x > canvas.width || this.x < 0 ) {
                this.directionX = -this.directionX;
            }
            if (this.y > canvas.height || this.y < 0) {
                this.directionY = -this.directionY;
            }

            //check collision detection - mouse position / particle position
            let dx = mouse.x - this.x;
            let dy = mouse.y - this.y;
            let distance = Math.sqrt(dx*dx + dy*dy);
            if (distance < mouse.radius + this.size){
                if (mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                    this.x += 10;
                }
                if (mouse.x > this.x && this.x > this.size * 10) {
                    this.x -= 10;
                }
                if (mouse.y < this.y && this.y < canvas.height - this.size * 10) {
                    this.y += 10;
                }
                if (mouse.y > this.y && this.y > this.size * 10) {
                    this.y -= 10;
                }
            }
            // move particle
            this.x += this.directionX;
            this.y += this.directionY;
            // draw particle
            this.draw();

        }
    }

    // create particle array
    function init() {
        particlesArray = [];
        let numberOfParticles = (canvas.height * canvas.width) / 9000;
        for (let i = 0; i < numberOfParticles; i++) {
            let size = (Math.random() * 5) + 1;
            let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2);
            let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2);
            let directionX = (Math.random() * 5) - 2.5;
            let directionY = (Math.random() * 5) - 2.5;
            let color = '#8C5523';

            particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
        }
    }

    // check if particles are close enough to draw line between them
    function connect(){
        let opacityValue = 1;
        for (let a = 0; a < particlesArray.length; a++) {
            for (let b = a; b < particlesArray.length; b++) {
                let distance = (( particlesArray[a].x - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x))
                    + ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y));
                if (distance < (canvas.width/7) * (canvas.height/7)) {
                    opacityValue = 1 - (distance/20000);
                    let dx = mouse.x - particlesArray[a].x;
                    let dy = mouse.y - particlesArray[a].y;
                    let mouseDistance = Math.sqrt(dx*dx+dy*dy);
                    if (mouseDistance < 180) {
                        ctx.strokeStyle='rgba(255,0,0,' + opacityValue + ')';
                    } else {
                        ctx.strokeStyle='rgba(0,0,255,' + opacityValue + ')';
                    }
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                    ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                    ctx.stroke();

                    ctx.lineWidth = 1;
                    ctx.strokeStyle = 'rgba(255,255,0,0.03)';
                    ctx.beginPath();
                    ctx.moveTo(mouse.x, mouse.y);
                    ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                    ctx.stroke();
                }
            }

        }
    }
    // animation loop
    function animate() {
        requestAnimationFrame(animate);
        ctx.clearRect(0,0,innerWidth, innerHeight);

        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
        }
        connect();
    }
    // resize event
    window.addEventListener('resize',
        function(){
            canvas.width = innerWidth;
            canvas.height = innerHeight;
            mouse.radius = ((canvas.height/80) * (canvas.height/80));
            init();
        }
    );

    // mouse out event
    window.addEventListener('mouseout',
        function(){
            mouse.x = undefined;
            mouse.x = undefined;
        }
    )

    init();
    animate();

</script>
@endsection
