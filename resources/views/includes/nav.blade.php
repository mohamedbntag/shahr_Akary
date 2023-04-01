<div class="link aside">
    <div class="navImage">
        <img src="{{asset("image/shar3.jpg")}}" alt="image">
    </div>

    <h5>{{Auth::user()->name_arabic}}</h5>
    <ul >
        <li>
            <a href="{{route('home') }}" class="link active">
                <span class="">تسجيل شهادة</span>
                <i class="fa fa-home fa-lg " aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('testimonials.index') }}" class="link">
                <span class="">عرض التقارير</span>
                <i class="fa fa-home fa-lg " aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a  href="#" class="link add_editors">
                <span class="">اضافة محررات</span>
                <i class="fa fa-home fa-lg " aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a  href="#" class="link add_search">
                <span class="">اضافة بحث</span>
                <i class="fa fa-home fa-lg " aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="{{route('form_city.index')}}" class="link">
                <span class="">اضافة مدينة</span>
                <i class="fa fa-home fa-lg " aria-hidden="true"></i>
            </a>
        </li>

        <li>
            <a class="link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                <span class="">تسجيل الخروج</span>
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>

    <div class="created_By">Created By <br> Mohamed Tag Eldin</div>
</div>
