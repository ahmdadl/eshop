<footer class="footer pt-5 mt-5 bg-dark">
    <div class="container text-light">
        <div class="row">
            <div class="col-sm-6 mb-5">
                <h4 class="text-light">{{__('t.footer.followUs')}}</h4>
                <div class="mx-auto">
                    <a href='https://github.com/abo3adel' target="_blank"
                        class="btn btn-outline-primary btn-brand transition fast mr-2 mt-2" aria-label="Github">
                        <i class='fab fa-github'></i>
                    </a>
                    <a href='https://codepen.io/abo3adel' target="_blank"
                        class="btn btn-outline-danger btn-brand transition fast mr-2 mt-2" aria-label="Codepen">

                        <i class='fab fa-codepen'></i>
                    </a>
                    <a href='https://www.linkedin.com/in/ahmed-adel-30a932119/'
                        target="_blank"
                        class="btn btn-outline-info btn-brand transition fast mr-2 mt-2" aria-label="Linked">
                        <i class='fab fa-linkedin-in'></i>
                    </a>
                    <a href='https://fb.com/a7md200' target="_blank"
                        class="btn btn-outline-primary btn-brand transition fast mr-2 mt-2" aria-label="">
                        <i class='fab fa-facebook-f'></i>
                    </a>
                    <a href='https://wa.me/201143647417' target="_blank"
                        class="btn btn-outline-success btn-brand transition fast mr-2 mt-2" aria-label="">
                        <i class='fab fa-whatsapp'></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>{{__('t.footer.myAccount')}}</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-dark border-0">
                        <a class="text-light" href="{{ route('login') }}">
                            {{ __('t.Login') }}
                        </a>
                    </li>
                    <li class="list-group-item bg-dark border-secondary">
                        <a class="text-light"
                            href="/{{app()->getLocale()}}/cart/checkout">
                            {{ __('t.scart.shopp') }}
                        </a>
                    </li>
                    <li class="list-group-item bg-dark border-secondary">
                        <a class="text-light" @auth
                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/profile" @else href="{{ route('login') }}" @endauth>
                            {{ __('t.user.menu.profile') }}
                        </a>
                    </li>
                    <li class="list-group-item bg-dark border-secondary">
                        <a class="text-light" @auth
                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/orders" @else href="{{ route('login') }}" @endauth>
                            {{ __('t.user.menu.order') }}
                        </a>
                    </li>
                    <li class="list-group-item bg-dark border-secondary">
                        <a class="text-light" @auth
                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/products" @else href="{{ route('login') }}" @endauth>
                            {{ __('t.user.menu.prod') }}
                        </a>
                    </li>
                    <li class="list-group-item bg-dark border-secondary">
                        <a class="text-light" @auth
                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/clients" @else href="{{ route('login') }}" @endauth>
                            @lang('t.user.menu.clients')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row border-top mt-3 border-secondary">
            <div class="col-12 pt-2 pb-2 text-center copy">
                <h5>
                    Made With <span class="text-danger">&hearts;</span> by <a
                        class="text-danger" target="_blank"
                        href="https://abo3adel.github.io/">Ahmed Adel</a> &copy;
                    2020
                </h5>
            </div>
        </div>
    </div>
</footer>